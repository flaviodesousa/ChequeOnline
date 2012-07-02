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
INSERT INTO Cheques (associado, cliente, banco, agencia, conta, numero, valor, emissao, vencimento, pago, devolucao_motivo, devolucao_data) VALUES (1,12345678901,123,4567,12341234,5050,100.00,'1999-09-06','1999-09-16',0,NULL,NULL),(1,12345678901,3,123,111,50,250.00,'1999-09-06','1999-10-06',0,NULL,NULL),(1,12345678901,3,123,111,51,118.00,'1999-09-06','1999-10-10',0,NULL,NULL),(1,12345678901,12,444,8090100,888,700.00,'1999-09-06','1999-12-26',0,NULL,NULL),(1,12345678901,123,4567,8901234,7070,380.00,'1999-06-05','1999-07-15',0,7,'1999-07-17'),(1,55365060644,1,1,121,122,200.00,'1999-09-06','1999-10-07',0,NULL,NULL),(1,55365060644,1,1,123,120,150.00,'1999-09-06','1999-09-30',0,NULL,NULL),(1,55365060644,1,125,125,100,150.00,'1999-09-17','1999-10-17',0,NULL,NULL),(1,55365060644,1,2,3,4,1800.00,'1999-09-18','1999-12-18',0,NULL,NULL),(1,55365060644,1,2,5,12,2000.00,'1999-09-18','1999-12-18',0,11,'1999-09-27'),(1,55365060644,128,129,130,140,120.00,'1999-09-23','1999-09-30',0,NULL,NULL),(1,55365060644,129,130,140,150,200.00,'1999-09-23','1999-09-24',0,NULL,NULL),(1,55365060644,10,10,11,128,955.00,'1999-09-26','1999-09-30',0,12,'1999-09-27'),(1,55365060644,11,11,11,11,1500.00,'1999-09-26','1999-09-30',0,11,'1999-09-26'),(1,55365060644,128,129,130,131,10000.00,'1999-09-27','1999-09-28',0,NULL,NULL),(1,55365060644,1,1,1,100,1500.00,'1999-09-27','1999-11-27',0,NULL,NULL),(1,2693763134,12,12,12,12,200.00,'1999-09-27','1999-10-27',0,11,'1999-09-27'),(1,2693763134,12,12,12,13,300.00,'1999-09-27','1999-12-27',0,NULL,NULL),(1,55365060644,1,1,12,10,150.00,'1999-10-02','1999-11-02',0,NULL,NULL),(1,55365060644,1,100,100,11,350.00,'1999-10-02','1999-11-03',0,NULL,NULL);
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
  fone_residencial varchar(64),
  fone_residencial_recados int(1),
  fone_comercial varchar(64),
  trabalho_local varchar(128),
  trabalho_funcao varchar(64),
  trabalho_tempo int, 
  trabalho_salario decimal(14,2),
  trabalho_outras_rendas decimal(14,2),
  observacoes text,
  PRIMARY KEY (id),
  KEY ClientesPorNome (nome)
);

#
# Dumping data for table 'Clientes'
#

LOCK TABLES Clientes WRITE;
INSERT INTO Clientes (id, nome, fantasia, endereco, bairro, cidade, estado, cep, fone_residencial, observacoes) VALUES (12345678901,'José João da Silva','Zé João','Av Goiás 1234, Apartamento 202','Centro','Anápolis','GO','75123-567','324-1234 até o meio-dia 311-7070 depois','Comentários genéricos,\r\nsem formatação\r\n\r\nPodem\r\nser\r\nescritas\r\ndiversas\r\nlinhas\r\n\r\n...como é comum nesse caso'),(55365060644,'Makário Luiz Orozimbo','','','','Anápolis','GO','75125200','3112533','');
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

