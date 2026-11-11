<?php
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/conexao.php';

$resposta = [
    'success' => false,
    'itens' => [],
    'total' => 0,
    'message' => ''
];

try {
    // Relatório centrado nas rotas:
    // 1) toda rota aparece, com os trens vinculados (rota_trem) e os sensores desse trem na rota;
    // 2) sensores cuja rota/trem não está em rota_trem também aparecem, para nada ficar de fora.
    $colunas = "
            r.id_rota,
            r.nome AS rota_nome,
            r.origem,
            r.destino,
            r.distancia_km,
            t.id_trem,
            t.nome AS trem_nome,
            t.status_operacional AS trem_status,
            t.latitude,
            t.longitude,
            u.id_usuario,
            u.nome AS responsavel_nome,
            u.matricula,
            u.cargo,
            s.id_sensor,
            s.nome AS sensor_nome,
            s.tipo_dado,
            s.localizacao,
            s.status AS sensor_status,
            s.descricao
    ";

    $sql = "
        SELECT $colunas
        FROM rotas r
        LEFT JOIN rota_trem rt ON rt.id_rota = r.id_rota
        LEFT JOIN trens t ON t.id_trem = rt.id_trem
        LEFT JOIN usuarios u ON u.id_usuario = t.id_usuario
        LEFT JOIN sensores s ON s.id_trem = t.id_trem AND s.id_rota = r.id_rota

        UNION ALL

        SELECT $colunas
        FROM sensores s
        INNER JOIN rotas r ON r.id_rota = s.id_rota
        INNER JOIN trens t ON t.id_trem = s.id_trem
        LEFT JOIN usuarios u ON u.id_usuario = t.id_usuario
        WHERE NOT EXISTS (
            SELECT 1 FROM rota_trem rt
            WHERE rt.id_rota = s.id_rota AND rt.id_trem = s.id_trem
        )

        ORDER BY rota_nome, trem_nome, sensor_nome
    ";

    $resultado = $conexao->query($sql);
    if (!$resultado) {
        throw new RuntimeException('Falha ao consultar dados do relatório.');
    }

    $itens = [];
    while ($linha = $resultado->fetch_assoc()) {
        $itens[] = [
            'id_sensor' => (int) ($linha['id_sensor'] ?? 0),
            'sensor_nome' => $linha['sensor_nome'] ?? '',
            'tipo_dado' => $linha['tipo_dado'] ?? '',
            'localizacao' => $linha['localizacao'] ?? '',
            'sensor_status' => $linha['sensor_status'] ?? '',
            'descricao' => $linha['descricao'] ?? '',
            'id_trem' => (int) ($linha['id_trem'] ?? 0),
            'trem_nome' => $linha['trem_nome'] ?? '',
            'trem_status' => $linha['trem_status'] ?? '',
            'latitude' => $linha['latitude'] ?? null,
            'longitude' => $linha['longitude'] ?? null,
            'id_rota' => (int) $linha['id_rota'],
            'rota_nome' => $linha['rota_nome'] ?? '',
            'origem' => $linha['origem'] ?? '',
            'destino' => $linha['destino'] ?? '',
            'distancia_km' => $linha['distancia_km'] ?? null,
            'id_usuario' => (int) ($linha['id_usuario'] ?? 0),
            'responsavel_nome' => $linha['responsavel_nome'] ?? '',
            'matricula' => $linha['matricula'] ?? '',
            'cargo' => $linha['cargo'] ?? ''
        ];
    }

    $resposta = [
        'success' => true,
        'itens' => $itens,
        'total' => count($itens),
        'message' => count($itens) > 0 ? 'Relatório carregado com sucesso.' : 'Nenhuma rota cadastrada para o relatório.'
    ];

    http_response_code(200);
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
    exit;
} catch (Throwable $erro) {
    http_response_code(500);
    $resposta['message'] = 'Não foi possível carregar o relatório solicitado.';
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
    exit;
}
