

CREATE DATABASE lavanderia;
USE lavanderia;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    peso DECIMAL(5,2),
    preco DECIMAL(10,2),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);