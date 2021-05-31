CREATE TABLE base_de_enderecos_ajax
(
	cep char(9) PRIMARY KEY,
	logradouro varchar(255), 
	cidade varchar(50),
	estado varchar(50)
) ENGINE=InnoDB;

CREATE TABLE pessoa
(
	codigo int PRIMARY KEY auto_increment,
	nome varchar(255),
	sexo varchar(15),
	email varchar(50) UNIQUE,
	telefone varchar(20),
	cep char(9),
	logradouro varchar(255),
	cidade varchar(50),
	estado varchar(50)
) ENGINE=InnoDB;

CREATE TABLE funcionario
(
	data_contrato date,
	salario float,
	senha_hash varchar(512),
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
);

CREATE TABLE medico
(
	especialidade varchar(100),
	crm varchar(100) UNIQUE,
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES funcionario(codigo) ON DELETE CASCADE
);

CREATE TABLE paciente
(
	peso int,
	altura int,
	tipo_sanguineo varchar(5),
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
);

CREATE TABLE agenda
(
	codigo int PRIMARY KEY auto_increment,
	data date,
	horario time,
	nome varchar(255),
	sexo varchar(15),
	email varchar(50),
	codigo_medico int,
	FOREIGN KEY (codigo_medico) REFERENCES medico(codigo) ON DELETE CASCADE
);