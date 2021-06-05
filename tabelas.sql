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
	salario int,
	senha_hash varchar(512),
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE medico
(
	especialidade varchar(100),
	crm varchar(100) UNIQUE,
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES funcionario(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE paciente
(
	peso int,
	altura int,
	tipo_sanguineo varchar(5),
	codigo int PRIMARY KEY,
	FOREIGN KEY (codigo) REFERENCES pessoa(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE agenda
(
	codigo int PRIMARY KEY auto_increment,
	data date,
	horario int,
	nome varchar(255),
	sexo varchar(15),
	email varchar(50),
	codigo_medico int,
	FOREIGN KEY (codigo_medico) REFERENCES medico(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO pessoa(nome, sexo, email, telefone, cep, logradouro, cidade, estado) VALUES
('Administrador', 'M', 'adm@adm.com', '99 9999-9999', 'N/A', 'N/A', 'N/A', 'N/A');

INSERT INTO funcionario(data_contrato, salario, senha_hash, codigo) VALUES
('2021-01-01', 9999, '$2y$12$4b/0cQh2B4T5LDArC57Bf.iv4.MGTh.YO12NigoZ9PIvSiXib/ljW', 1);
