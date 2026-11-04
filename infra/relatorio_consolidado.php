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
    $sql = "
        SELECT
            s.id_sensor,
            s.nome AS sensor_nome,
            s.tipo_dado,
            s.localizacao,
            s.status AS sensor_status,
            s.descricao,
            t.id_trem,
            t.nome AS trem_nome,
            t.status_operacional AS trem_status,
            t.latitude,
            t.longitude,
            r.id_rota,
            r.nome AS rota_nome,
            r.origem,
            r.destino,
            r.distancia_km,
            u.id_usuario,
            u.nome AS responsavel_nome,
            u.matricula,
            u.cargo
        FROM sensores s
        INNER JOIN trens t ON t.id_trem = s.id_trem
        INNER JOIN rotas r ON r.id_rota = s.id_rota
        INNER JOIN usuarios u ON u.id_usuario = t.id_usuario
        ORDER BY r.nome, t.nome, s.nome
    ";

    $resultado = $conexao->query($sql);
    if (!$resultado) {
        throw new RuntimeException('Falha ao consultar dados do relatório.');
    }

    $itens = [];
    while ($linha = $resultado->fetch_assoc()) {
        $itens[] = [
            'id_sensor' => (int) $linha['id_sensor'],
            'sensor_nome' => $linha['sensor_nome'] ?? '',
            'tipo_dado' => $linha['tipo_dado'] ?? '',
            'localizacao' => $linha['localizacao'] ?? '',
            'sensor_status' => $linha['sensor_status'] ?? '',
            'descricao' => $linha['descricao'] ?? '',
            'id_trem' => (int) $linha['id_trem'],
            'trem_nome' => $linha['trem_nome'] ?? '',
            'trem_status' => $linha['trem_status'] ?? '',
            'latitude' => $linha['latitude'] ?? null,
            'longitude' => $linha['longitude'] ?? null,
            'id_rota' => (int) $linha['id_rota'],
            'rota_nome' => $linha['rota_nome'] ?? '',
            'origem' => $linha['origem'] ?? '',
            'destino' => $linha['destino'] ?? '',
            'distancia_km' => $linha['distancia_km'] ?? null,
            'id_usuario' => (int) $linha['id_usuario'],
            'responsavel_nome' => $linha['responsavel_nome'] ?? '',
            'matricula' => $linha['matricula'] ?? '',
            'cargo' => $linha['cargo'] ?? ''
        ];
    }

    $resposta = [
        'success' => true,
        'itens' => $itens,
        'total' => count($itens),
        'message' => count($itens) > 0 ? 'Relatório carregado com sucesso.' : 'Nenhuma associação encontrada.'
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
