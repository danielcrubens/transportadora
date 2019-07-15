/*Criando o Database*/
CREATE DATABASE IF NOT EXISTS transportadora;
use transportadora;

/*Criando a Tabela motorista*/
CREATE TABLE IF NOT EXISTS motorista (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  login varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  senha varchar(100) NOT NULL,
  tipo varchar (20) not null default 'motorista',
  CONSTRAINT pk_motorista PRIMARY KEY (id),
  CONSTRAINT uk_mot_login UNIQUE (login)
);
 

/* Inserindo um novo registro
   Observe que no campo senha aplicamos a função MD5 para criptografar o
   conteudo
*/
INSERT INTO motorista (nome, login, email, senha,tipo) VALUES
('Administrador','admin','administrador@trans.com.br',MD5('12345'),'admin');
INSERT INTO motorista (nome, login, email, senha) VALUES
('José da Silva','jose','ad@trans.com.br',MD5('1'));
INSERT INTO motorista (nome, login, email, senha) VALUES
('Maria Lima','maria','maria@trans.com.br',MD5('1'));


/*Criando a Tabela viagem*/
CREATE TABLE IF NOT EXISTS viagem (
   idviagem int NOT NULL AUTO_INCREMENT,
  datahorasaida datetime NOT NULL,
  destino varchar(100)NOT NULL,
  tipodecarga varchar (100) NOT NULL,  
  datahorachegada datetime NULL,
  CONSTRAINT pk_viagem PRIMARY KEY (idviagem)
 );
INSERT INTO viagem (destino,tipodecarga,datahorasaida) values ('sorocaba','fracionada','2015-05-15 08:00');



/*Criando a Tabela veiculo*/
CREATE TABLE IF NOT EXISTS VEICULO (
  idveiculo int NOT NULL AUTO_INCREMENT,
  placa char (8) NOT NULL ,
  datamanutencao datetime NOT NULL,
  servicomanutencao boolean NOT NULL default true,  
CONSTRAINT pk_veiculo PRIMARY KEY (idveiculo)
);
INSERT INTO veiculo(placa,datamanutencao,servicomanutencao)values ('ASD-9875','2015-05-15','1' );
INSERT INTO veiculo(placa,datamanutencao,servicomanutencao)values ('ASD-7598','2017-05-15','0' );


/*Criando a Tabela manutencao*/
CREATE TABLE IF NOT EXISTS manutencao (
  idmanutencao int NOT NULL AUTO_INCREMENT,
  datamanutencao datetime NOT NULL,  
  placa char  (8) NOT NULL, 
  valormanutencao decimal(10,2) NOT NULL default 0, 
   CONSTRAINT pk_manutencao PRIMARY KEY (idmanutencao),
   CONSTRAINT fk_manutencao_veiculo foreign key (placa) references veiculo(placa)
);
 INSERT INTO manutencao(valormanutencao,placa,datamanutencao)values (36.51,'ASD-7598','2017-05-20');
  
 


