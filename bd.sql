CREATE DATABASE markdown;

USE markdown;

CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    txt VARCHAR(255) NOT NULL
);
