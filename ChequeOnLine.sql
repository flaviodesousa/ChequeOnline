# MySQL dump 6.0
#
# Host: localhost    Database: ChequeOnLine
#--------------------------------------------------------
# Server version	3.22.25

#
# Table structure for table 'Associados'
#
DROP TABLE IF EXISTS Associados;
CREATE TABLE Associados (
  codigo int(11) DEFAULT '0' NOT NULL,
  nome varchar(64),
  PRIMARY KEY (codigo)
);

#
# Dumping data for table 'Associados'
#

LOCK TABLES Associados WRITE;
INSERT INTO Associados (codigo, nome) VALUES (0,'CDL'),(1,'Associado de Teste');
UNLOCK TABLES;

#
# Table structure for table 'Cheques'
#
DROP TABLE IF EXISTS Cheques;
CREATE TABLE Cheques (
  associado int(11) DEFAULT '0' NOT NULL,
  cliente decimal(14,0) DEFAULT '0' NOT NULL,
  banco decimal(3,0) DEFAULT '0' NOT NULL,
  agencia decimal(4,0) DEFAULT '0' NOT NULL,
  conta decimal(10,0) DEFAULT '0' NOT NULL,
  numero decimal(10,0) DEFAULT '0' NOT NULL,
  valor decimal(14,2) DEFAULT '0.00' NOT NULL,
  emissao date DEFAULT '0000-00-00' NOT NULL,
  vencimento date DEFAULT '0000-00-00' NOT NULL,
  pago int(1) DEFAULT '0' NOT NULL,
  devolucao_motivo int(2),
  devolucao_data date,
  PRIMARY KEY (banco,agencia,conta,numero),
  KEY ChequesPorAssociado (associado,vencimento,numero),
  KEY ChequesPorClientePorData (cliente,vencimento,numero)
);

#
# Dumping data for table 'Cheques'
#

LOCK TABLES Cheques WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Clientes'
#
DROP TABLE IF EXISTS Clientes;
CREATE TABLE Clientes (
  id decimal(14,0) DEFAULT '0' NOT NULL,
  nome varchar(128) DEFAULT '' NOT NULL,
  fantasia varchar(128),
  endereco varchar(128),
  bairro varchar(64),
  cidade varchar(64),
  estado char(2),
  cep varchar(9),
  fone varchar(64),
  observacoes text,
  PRIMARY KEY (id),
  KEY ClientesPorNome (nome)
);

#
# Dumping data for table 'Clientes'
#

LOCK TABLES Clientes WRITE;
UNLOCK TABLES;

#
# Table structure for table 'Operadores'
#
DROP TABLE IF EXISTS Operadores;
CREATE TABLE Operadores (
  codigo int(11) DEFAULT '0' NOT NULL,
  nome varchar(64),
  associado int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (codigo)
);

#
# Dumping data for table 'Operadores'
#

LOCK TABLES Operadores WRITE;
INSERT INTO Operadores (codigo, nome, associado) VALUES (1,'Operador da CDL',0),(2,'Operador de Teste',1);
UNLOCK TABLES;

