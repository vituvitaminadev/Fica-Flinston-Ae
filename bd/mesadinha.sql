-- CREATE DATABASE MESADINHA;

-- USE MESADINHA;


CREATE TABLE USUARIOS(
ID INT UNSIGNED auto_increment NOT NULL PRIMARY KEY,
USUARIO VARCHAR(80) NOT NULL,
SENHA VARCHAR(150) NOT NULL,
EMAIL VARCHAR(100) NOT NULL,
SALDO DOUBLE(9,2) NOT NULL
)ENGINE=InnoDB;

 select * from  usuarios;
 select * from categorias;
 select * from movimentacoes;
-- select sum(valor) from movimentacoes where id_usuario=1;
-- select id_categoria from movimentacoes where data = '2020-11-13' and valor = 100;
-- drop database mesadinha;
-- insert into usuarios (id,usuario,senha,email,saldo) values(null, 'vitin', '123', 'b@b', 10000);
-- delete from categorias where id = 39;
-- update usuarios set saldo = 0 where id = 4;
-- select valor, id_categoria from movimentacoes where id_usuario = 5;

CREATE TABLE CATEGORIAS(
ID INT UNSIGNED auto_increment NOT NULL PRIMARY KEY,
ID_USUARIO INT UNSIGNED NOT NULL,
NOME VARCHAR(80) NOT NULL,
FOREIGN KEY (ID_USUARIO) REFERENCES USUARIOS(ID)
)ENGINE=INNODB;

CREATE TABLE MOVIMENTACOES(
ID INT UNSIGNED auto_increment NOT NULL PRIMARY KEY,
ID_USUARIO INT UNSIGNED NOT NULL,
VALOR DOUBLE(9,2) NOT NULL,
TIPO CHAR(1) NOT NULL,
ID_CATEGORIA INT UNSIGNED NOT NULL,
DATA DATE NOT NULL,
foreign key (ID_USUARIO) REFERENCES USUARIOS(ID),
foreign key (ID_CATEGORIA) references CATEGORIAS(ID)
)ENGINE=INNODB;