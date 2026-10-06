-- RailPulse — Script completo do banco de dados

CREATE DATABASE IF NOT EXISTS railpulse
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE railpulse;

-- Tabela: rotas
CREATE TABLE IF NOT EXISTS rotas (
    id_rota      INT AUTO_INCREMENT PRIMARY KEY,
    nome         VARCHAR(150)   NOT NULL,
    origem       VARCHAR(150)   NOT NULL,
    destino      VARCHAR(150)   NOT NULL,
    distancia_km DECIMAL(8,2)   NOT NULL CHECK (distancia_km > 0),
    criado_em    TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela: trens  (depende de rotas)
CREATE TABLE IF NOT EXISTS trens (
    id_trem             INT AUTO_INCREMENT PRIMARY KEY,
    nome                VARCHAR(100)  NOT NULL,
    modelo              VARCHAR(100)  NOT NULL,
    status_operacional  ENUM('normal','alerta','falha') NOT NULL DEFAULT 'normal',
    velocidade_atual    DECIMAL(6,2)  DEFAULT 0.00,
    latitude            DECIMAL(10,7),
    longitude           DECIMAL(10,7),
    id_rota             INT           NOT NULL,
    criado_em           TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    atualizado_em       TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_trens_rotas
        FOREIGN KEY (id_rota) REFERENCES rotas(id_rota)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: sensores  (depende de trens e rotas)
CREATE TABLE IF NOT EXISTS sensores (
    id_sensor    INT AUTO_INCREMENT PRIMARY KEY,
    nome         VARCHAR(100)  NOT NULL,
    tipo_dado    ENUM('velocidade','temperatura','falha','vibracao','pressao','umidade') NOT NULL,
    localizacao  VARCHAR(200)  NOT NULL,
    status       ENUM('ativo','em_espera','falha') NOT NULL DEFAULT 'ativo',
    descricao    TEXT,
    id_trem      INT           NOT NULL,
    id_rota      INT           NOT NULL,
    criado_em    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_sensores_trens
        FOREIGN KEY (id_trem) REFERENCES trens(id_trem)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_sensores_rotas
        FOREIGN KEY (id_rota) REFERENCES rotas(id_rota)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Tabela: dados_sensores  (depende de sensores)
CREATE TABLE IF NOT EXISTS dados_sensores (
    id_dado   INT AUTO_INCREMENT PRIMARY KEY,
    id_sensor INT           NOT NULL,
    valor     DECIMAL(10,2) NOT NULL,
    unidade   VARCHAR(20)   NOT NULL,
    data_hora TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_dados_sensor
        FOREIGN KEY (id_sensor) REFERENCES sensores(id_sensor)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario   INT AUTO_INCREMENT PRIMARY KEY,
    nome         VARCHAR(150)  NOT NULL,
    email        VARCHAR(200)  NOT NULL UNIQUE,
    senha        VARCHAR(255)  NOT NULL,
    matricula    VARCHAR(20)   NOT NULL UNIQUE,
    cargo        ENUM('admin','funcionario') NOT NULL DEFAULT 'funcionario',
    criado_em    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Índices
CREATE INDEX idx_trens_rota     ON trens(id_rota);
CREATE INDEX idx_sensores_trem  ON sensores(id_trem);
CREATE INDEX idx_sensores_rota  ON sensores(id_rota);
CREATE INDEX idx_dados_sensor   ON dados_sensores(id_sensor);

-- Dados iniciais — ORDEM CORRETA (respeita FK)
-- 1. Rotas primeiro
INSERT INTO rotas (nome, origem, destino, distancia_km) VALUES
('Rota Litoral Sul',      'Joinville',  'Florianópolis', 180.50),
('Rota Serra Catarinense','Lages',      'Curitibanos',    95.30),
('Rota Vale do Itajaí',   'Blumenau',   'Itajaí',         65.00),
('Rota Norte',            'Joinville',  'Curitiba',       120.80);

-- 2. Trens (referencia rotas)
INSERT INTO trens (nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota) VALUES
('Locomotiva Alpha', 'SD70ACe',  'normal',  85.50, -26.3044, -48.8487, 1),
('Locomotiva Beta',  'AC44i',    'alerta',  45.20, -26.2740, -48.6830, 1),
('Locomotiva Gamma', 'ES43BBi',  'normal', 110.00, -26.9167, -49.0661, 1),
('Locomotiva Delta', 'GT46MAC',  'falha',    0.00, -26.2250, -48.6353, 1);

-- 3. Sensores (referencia trens e rotas)
INSERT INTO sensores (nome, tipo_dado, localizacao, status, descricao, id_trem, id_rota) VALUES
('Sensor Velocidade A1',  'velocidade',  'Eixo dianteiro - Locomotiva Alpha',  'ativo',      'Monitora velocidade do eixo dianteiro',      1, 1),
('Sensor Temperatura A2', 'temperatura', 'Motor principal - Locomotiva Alpha',  'ativo',      'Monitora temperatura do motor principal',     1, 1),
('Sensor Vibração B1',    'vibracao',    'Truque traseiro - Locomotiva Beta',   'ativo',      'Monitora vibração do truque traseiro',        2, 2),
('Sensor Falha B2',       'falha',       'Sistema elétrico - Locomotiva Beta',  'em_espera',  'Detecta falhas no sistema elétrico',          2, 2),
('Sensor Pressão C1',     'pressao',     'Freios - Locomotiva Gamma',           'ativo',      'Monitora pressão do sistema de frenagem',     3, 2),
('Sensor Temperatura D1', 'temperatura', 'Motor diesel - Locomotiva Delta',     'falha',      'Sensor com defeito - aguardando manutenção',  4, 3);

-- 4. Dados dos sensores
INSERT INTO dados_sensores (id_sensor, valor, unidade, data_hora) VALUES
(1, 85.50, 'km/h', '2026-05-20 08:00:00'),
(1, 90.20, 'km/h', '2026-05-20 08:05:00'),
(1, 78.10, 'km/h', '2026-05-20 08:10:00'),
(1, 92.00, 'km/h', '2026-05-20 08:15:00'),
(2, 72.30, '°C',   '2026-05-20 08:00:00'),
(2, 74.10, '°C',   '2026-05-20 08:05:00'),
(2, 76.50, '°C',   '2026-05-20 08:10:00'),
(3,  2.40, 'mm/s', '2026-05-20 08:00:00'),
(3,  3.10, 'mm/s', '2026-05-20 08:05:00'),
(3,  5.80, 'mm/s', '2026-05-20 08:10:00'),
(5,  7.20, 'bar',  '2026-05-20 08:00:00'),
(5,  7.10, 'bar',  '2026-05-20 08:05:00'),
(5,  6.95, 'bar',  '2026-05-20 08:10:00'),
(6, 120.50,'°C',   '2026-05-20 07:50:00'),
(6, 135.80,'°C',   '2026-05-20 07:55:00'),
(6, 142.00,'°C',   '2026-05-20 07:58:00');

-- 5. Usuários
INSERT INTO usuarios (nome, email, senha, matricula, cargo) VALUES
('Administrador Master', 'admin@gmail.com', '$2y$10$hzzAyq0tdLb83.4g2zqfHeo2x0JW1S68PiiJ47/SlM60OiG1RtMyi', '0001', 'admin'),
('Nicolas Lopes', 'nicolas@empresa.com', '$2y$10$4A74XWST0RyRU7r/cmOSZ.gHtwBC9BtgFlrMDAeZ7o.ZMaFsb3HVm', '0002', 'admin'),
('Arthur Vieira', 'arthur@empresa.com', '$2y$10$4A74XWST0RyRU7r/cmOSZ.gHtwBC9BtgFlrMDAeZ7o.ZMaFsb3HVm', '0003', 'funcionario'),
('Gabriel Ostrovski', 'gabriel@empresa.com', '$2y$10$4A74XWST0RyRU7r/cmOSZ.gHtwBC9BtgFlrMDAeZ7o.ZMaFsb3HVm', '0004', 'funcionario'),
('Gustavo Miquelute', 'mk@gmail.com', '$2y$10$hzzAyq0tdLb83.4g2zqfHeo2x0JW1S68PiiJ47/SlM60OiG1RtMyi', '0011', 'admin');
