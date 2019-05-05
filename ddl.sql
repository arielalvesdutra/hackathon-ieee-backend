CREATE DATABASE IF NOT EXISTS jarvis default charset utf8;

use jarvis;

CREATE TABLE IF NOT EXISTS grandezas_eletricas (
    id INT NOT NULL AUTO_INCREMENT,
    sn VARCHAR(30) NOT NULL,
    tensao FLOAT NOT NULL,
    corrente FLOAT NOT NULL,
    potencia_aparente FLOAT NOT NULL,
    potencia_ativa FLOAT NOT NULL,
    potencia_reativa FLOAT NOT NULL,
    fator_potencia FLOAT NOT NULL,
    energia_acumulada FLOAT NOT NULL,
    data_criacao VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
)engine=InnoDb;


CREATE TABLE IF NOT EXISTS faltas_de_energia (
    id INT NOT NULL AUTO_INCREMENT,
    sn VARCHAR(30) NOT NULL,
    inicio VARCHAR(30) NOT NULL,
    final VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
)engine=InnoDb;