CREATE TABLE ALUNOS (
	id INT(11) NOT NULL AUTO_INCREMENT,
	email VARCHAR(50) NOT NULL, 
	password VARCHAR(70) NOT NULL,
	nome VARCHAR(70) NOT NULL, 
	sex CHAR(12), 
	cpf VARCHAR(11) NOT NULL,
	endereco VARCHAR(50) NOT NULL,
	cidade VARCHAR(50) NOT NULL,
	estado VARCHAR(50) NOT NULL,
	cep VARCHAR(12) NOT NULL,
	bairro VARCHAR(40) NOT NULL,
	data_nascimento DATE NOT NULL, 
	cidade_natal  VARCHAR(50),
	PRIMARY KEY ( id )
);

CREATE TABLE CURSOS (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(70) NOT NULL, 
	status_curso VARCHAR(40) NOT NULL, 
	url_image VARCHAR(50) NOT NULL,
	apostila VARCHAR(1000) NOT NULL,
	video VARCHAR(1000) NOT NULL,
	id_aluno INT(100) NOT NULL,
	PRIMARY KEY ( id ),
	CONSTRAINT FK_ALUNOCURSO_ALUNO FOREIGN KEY (id_aluno) REFERENCES ALUNOS(id)
);
-- removido materiais tem uma coluna para cada material em curso

-- CREATE TABLE MATERIAIS (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	id_curso INT(11) NOT NULL,
-- 	nome VARCHAR(70) NOT NULL, 
-- 	tipo VARCHAR(10) NOT NULL,
-- 	url VARCHAR(50) NOT NULL,
-- 	PRIMARY KEY ( id ),
-- 	CONSTRAINT FK_MATERIAIS_CURSO FOREIGN KEY (id_curso) REFERENCES CURSOS(id)
-- );


-- removido aluno curso eles já se relacionam na tabela tentativas

-- CREATE TABLE ALUNO_CURSO (
-- 	id INT(11) NOT NULL AUTO_INCREMENT,
-- 	id_aluno INT(11) NOT NULL,
-- 	id_curso INT(11) NOT NULL,
-- 	PRIMARY KEY ( id),
-- 	CONSTRAINT FK_ALUNOCURSO_ALUNO FOREIGN KEY (id_aluno) REFERENCES ALUNOS(id),
-- 	CONSTRAINT FK_ALUNOCURSO_CURSO FOREIGN KEY (id_curso) REFERENCES CURSOS(id)
-- );



CREATE TABLE PROVAS (
	id INT(11) NOT NULL AUTO_INCREMENT,
	id_curso INT(11) NOT NULL,
	questoes varchar(4000) NOT NULL, 
	PRIMARY KEY ( id )
);



CREATE TABLE TENTATIVAS (
	id INT(11) NOT NULL AUTO_INCREMENT,
	id_aluno INT(11) NOT NULL,
	id_curso INT(11) NOT NULL,
	id_prova INT(11) NOT NULL,
	num_tentativa INT(2) NOT NULL,
	data DATE NOT NULL, 
	respostas VARCHAR(4000) NOT NULL,
	nota VARCHAR(5) NOT NULL,
	PRIMARY KEY ( id )	
);


ALTER TABLE PROVAS ADD CONSTRAINT FK_PROVA_CURSO FOREIGN KEY (id_curso) REFERENCES CURSOS(id);


ALTER TABLE TENTATIVAS ADD CONSTRAINT FK_TENTATIVAS_ALUNO FOREIGN KEY (id_aluno) REFERENCES ALUNOS(id);
ALTER TABLE TENTATIVAS ADD CONSTRAINT FK_TENTATIVAS_CURSO FOREIGN KEY (id_curso) REFERENCES CURSOS(id);
ALTER TABLE TENTATIVAS ADD CONSTRAINT FK_TENTATIVAS_PRPOVA FOREIGN KEY (id_prova) REFERENCES PROVAS(id);

-- criar repostas vazias
-- na coluna de questoes o objJson tem uma tributo pergunta e o resposta que é preenchido pelo aluno;
--update PROVAS SET questoes='{"questoes":[{"id":"1","descricao":"Ember corresponde um framework JS","pergunta":"SIM","resposta":""},{"id":"2","descricao":"Ember corresponde a SPA ?","pergunta":"SIM","resposta":""},{"id":"3","descricao":"Ember se baseia em MVC ?","pergunta":"SIM","resposta":""},{"id":"4","descricao":"Ember tem carregamento leve ?","pergunta":"SIM","resposta":""},{"id":"5","descricao":"Ember tem como mascote um elefante","pergunta":"NAO","resposta":""}]}';
