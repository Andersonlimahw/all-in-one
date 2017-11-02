-- ALUNOS

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (1,"anderson@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","Rua Walt Disney ","Ferraz de Vasconcelos","SP","08527051","Parque Dourado","1990-10-10","Tokyo");

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (2,"anderson2@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","","","","01318-906","","1990-10-10","Tokyo");

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (3,"anderson3@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","","","","01318-906","","1990-10-10","Tokyo");

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (4,"anderson4@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","","","","01318-906","","1990-10-10","Tokyo");

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (5,"anderson5@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","","","","01318-906","","1990-10-10","Tokyo");

INSERT INTO `ALUNOS`(`id`, `email`, `password`, `nome`, `sex`, `cpf`, `endereco`, `cidade`, `estado`,`cep`, `bairro`,`data_nascimento`, `cidade_natal`) VALUES (6,"anderson6@allinone.com","all-in-one","Anderson Lima","Masculino","51994428643","","","","01318-906","","1990-10-10","Tokyo");


--ALUNO CURSO , removido aluno curso

-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (1,1);
-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (2,1);
-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (3,1);
-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (4,1);
-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (5,1);
-- INSERT INTO `ALUNO_CURSO`(`id_aluno`, `id_curso`) VALUES (6,1);


-- CURSO, 
INSERT INTO `CURSOS`(`id`, `nome`, `status_curso`, `url_image`, `apostila`, `video`, `id_aluno`) VALUES (1,"EMBERJS", "FAZER" ,"assets/img/cursos/emberjs.png",'https://www.caelum.com.br/download/caelum-java-objetos-fj11.pdf',"materiais/pdf/emberjs.pdf",1);


-- MATERIAIS, REMOVIDO MATERIAIS
-- INSERT INTO `MATERIAIS`(`id`, `id_curso`, `nome`, `tipo`, `url`) VALUES (1,1,"Apostila","PDF","http://www.ouropreto.ifmg.edu.br/dw/apostilas/desenvolvimento-web-com-html-css-e-javascript");

-- INSERT INTO `MATERIAIS`(`id`, `id_curso`, `nome`, `tipo`, `url`) VALUES (2,1,"aula alura","VIDEO","https://www.youtube.com/watch?v=T-JVRDnykYg");

--PROVAS

INSERT INTO `PROVAS`(`id`, `id_curso`, `questoes`) VALUES (1,8,'{"questoes":[{"id":"1","descricao":"Ember corresponde um framework JS","pergunta":"SIM","resposta":""},{"id":"2","descricao":"Ember corresponde a SPA ?","pergunta":"SIM","resposta":""},{"id":"3","descricao":"Ember se baseia em MVC ?","pergunta":"SIM","resposta":""},{"id":"4","descricao":"Ember tem carregamento leve ?","pergunta":"SIM","resposta":""},{"id":"5","descricao":"Ember tem como mascote um elefante","pergunta":"NAO","resposta":""}]}');

INSERT INTO `PROVAS`(`id`, `id_curso`, `questoes`) VALUES (2,7,'{"questoes":[{"id":"1","descricao":"Ember corresponde um framework JS","pergunta":"SIM","resposta":""},{"id":"2","descricao":"Ember corresponde a SPA ?","pergunta":"SIM","resposta":""},{"id":"3","descricao":"Ember se baseia em MVC ?","pergunta":"SIM","resposta":""},{"id":"4","descricao":"Ember tem carregamento leve ?","pergunta":"SIM","resposta":""},{"id":"5","descricao":"Ember tem como mascote um elefante","pergunta":"NAO","resposta":""}]}');


--TENTATIVAS

INSERT INTO `TENTATIVAS`(`id`, `id_aluno`, `id_curso`, `id_prova`, `num_tentativa`, `data`, `questoes`, `nota`)
VALUES 
(100,14,8,1,1,"2017-10-10",'{"questoes":[{"id":"1","descricao":"Ember corresponde um framework JS","pergunta":"SIM","resposta":"SIM"},{"id":"2","descricao":"Ember corresponde a SPA ?","pergunta":"SIM","resposta":"SIM"},{"id":"3","descricao":"Ember se baseia em MVC ?","pergunta":"SIM","resposta":"SIM"},{"id":"4","descricao":"Ember tem carregamento leve ?","pergunta":"SIM","resposta":"SIM"},{"id":"5","descricao":"Ember tem como mascote um elefante","pergunta":"NAO","resposta":"NAO"}]}',9);
