CREATE DATABASE IF NOT EXISTS sistemaMalharia;
USE sistemaMalharia;

-- Tabela de usuários (malharia)
CREATE TABLE malharia (
    id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (login)
);

CREATE TABLE estoque (
    id INT NOT NULL AUTO_INCREMENT,
    nome_produto VARCHAR(150) NOT NULL,
    descricao TEXT,
    quantidade INT NOT NULL,
    quantidade_minima INT DEFAULT NULL,    observacoes TEXT,
    nome_imagem VARCHAR(255) DEFAULT NULL,
    malharia_id INT NOT NULL,
    data_atualizacao DATE DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (malharia_id) REFERENCES malharia(id) ON DELETE CASCADE
);

CREATE TABLE movimentacao_estoque (
    id INT NOT NULL AUTO_INCREMENT,
    estoque_id INT NOT NULL,
    malharia_id INT NOT NULL,
    tipo_movimento ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL,
    data_movimento DATE NOT NULL,
    observacao VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (estoque_id) REFERENCES estoque(id) ON DELETE CASCADE,
    FOREIGN KEY (malharia_id) REFERENCES malharia(id) ON DELETE CASCADE
);