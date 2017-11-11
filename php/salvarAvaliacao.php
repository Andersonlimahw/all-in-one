
<!DOCTYPE html>
<html>
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="ALt Technology">
    <meta name="description" content="Portal univesitário">
    <meta name="keywords" content="Portal univesitário">
    
    <link rel="shortcut icon" href="https://www.appdynamics.co.uk/static/img/favicon.ico">
    
    <title>ALL IN ONE | AVALIAÇÃO</title>
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="../assets/css/main.css" rel="stylesheet"/>

</head>
<body>

<div class="banner-sucesso">

    <center><h1> GABARITO</h1> </center>
    
    <?php 
        session_start();
        require ('../bd/connect.php');
        if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
            $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
            $idAluno = $_SESSION['idAluno']; // pegar via GET queryparam
            $idProva = $_SESSION['idProva']; //
            $idCurso = $_SESSION['idCurso']; //
            
            // $_SESSION['cursoFeito'] = "SIM";

            
            // $nota = 10;

            $numTentativa = 1;
            
            $data = date('Y-m-d');
            // $data = date('dd-mm-yyyy');

            //repostas selecionadas 

            $resposta1 = $_POST['resposta1'];
            $resposta2 = $_POST['resposta2'];
            $resposta3 = $_POST['resposta3'];
            $resposta4 = $_POST['resposta4'];
            $resposta5 = $_POST['resposta5'];

            // montar obj Json , preechendo com as respostas selecionadas a ser atualizado na coluna questões
            $questoesAtualizadas = '{"questoes":[{"id":"1","descricao":"Ember corresponde um framework JS","pergunta":"SIM","resposta":"'.$resposta1.'"},{"id":"2","descricao":"Ember corresponde a SPA ?","pergunta":"SIM","resposta":"'.$resposta2.'"},{"id":"3","descricao":"Ember se baseia em MVC ?","pergunta":"SIM","resposta":"'.$resposta3.'"},{"id":"4","descricao":"Ember tem carregamento leve ?","pergunta":"SIM","resposta":"'.$resposta4.'"},{"id":"5","descricao":"Ember tem como mascote um elefante","pergunta":"NAO","resposta":"'.$resposta5.'"}]}';        

            // calcular nota
            // $nota = $_SESSION['nota']; // cada questão vale 2 pontos, por na sessão
            $nota = 0;
            $json_str = $questoesAtualizadas;    
            // faz o parsing da string , criando o array questoes
            $jsonObj = json_decode($json_str);
            $questoes = $jsonObj ->questoes;

            foreach($questoes as $q){
                
                $pergunta = $q ->pergunta;
                $resposta = $q ->resposta;

                if($resposta == $pergunta){
                    $nota += 2;
                } else {
                    $nota = $nota;
                }
                
                // echo "Resposta: " .$resposta. "Pergunta: ".$pergunta."<br>";
                echo '<div class="gabarito-item"> 
                        
                        <div class="gabarito-questao col "><b>Questão: </b> '.$q->id.'</div>
                        <div class="gabarito-pergunta col md4"><b>Descrição:</b> '.$q->descricao.'</div>
                        <div class="gabarito-pergunta col md4"><b>Resposta Certa:</b> '.$pergunta.'</div>
                        <div class="gabarito-resposta col md4"><b>Sua Resposta:</b> '.$resposta.'</div>
                        
                      </div>
                     ';
            }

            echo '<div class="gabarito-nota-final">Nota final: '.$nota.' de 10</div>';
            
            
            $query = "SELECT * FROM TENTATIVAS where id_curso='$idCurso' and id_aluno='$idAluno' and id_prova='$idProva' "; /// verifica se já tentou se sim atualiza senão insere
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                // se o aluno já fez algum curso atualiza
            


                $query = "UPDATE TENTATIVAS SET num_tentativa=num_tentativa+1, data='$data', nota ='$nota', questoes='$questoesAtualizadas' WHERE id_prova='$idProva' and id_aluno='$idAluno' and id_curso='$idCurso' "; 
                echo '<script> console.info("TENTATIVAS salva com sucesso !");</script>';
                echo '<center> <h3> AVALIAÇÃO ATUALIZADA COM SUCESSO !</h3></center>';
                echo "<center><h3>login: " .$login. ", aluno: ".$idAluno.", curso: ".$idCurso.", prova: ".$idProva."</h3> </center>";
                echo "<center> <a class='btn' href='../meu-perfil.php'>MINHAS AVALIAÇÕES</a></center>";
                // echo "<center> <a class='btn' href='../meu-perfil.php'>MINHAS AVALIAÇÕES</a> <a class='btn' href='../avaliacao-feita.php?idCursoParam='.$idCurso.'&notaParam='.$nota.'&idAlunoParam='.$idAluno.'&idProvaParam='.$idProva.' '> VER RESULTADO </a></center>";
                
                // header ('Location: ../meu-perfil.php');

            } else {

                $query = "INSERT INTO TENTATIVAS(id_aluno, id_curso, id_prova, num_tentativa, data, questoes, nota)"
                . "VALUES ('$idAluno', '$idCurso', '$idProva', '$numTentativa', '$data', '$questoesAtualizadas', '$nota')";

                echo '<script> console.info("TENTATIVAS salva com sucesso!");</script>';
                
                // header ('Location: ../meu-perfil.php');
                    
                if(mysqli_query($con, $query)){
                    
                    echo '<script> console.info("Prova criada com sucesso !");</script>';
                    echo '<script> console.info("TENTATIVAS salva com sucesso !");</script>';
                    echo '<center> <h1> AVALIAÇÃO CRIADA COM SUCESSO !</h1></center>';
                    echo "<center><h2>login: " .$login. ", aluno: ".$idAluno.", curso: ".$idCurso.", prova: ".$idProva."</h2> </center>";
                    echo '<center> <a class="btn" href="../meu-perfil.php">MINHAS AVALIAÇÕES </a>  </center>';
                    // echo '<center><a href="avaliacao-feita.php?idCursoParam='.$idCurso.'&notaParam='.$nota.'&idAlunoParam='.$idAluno.'&idProvaParam='.$idProva.' "> ver resultado </a> </center>';
                    // header ('Location: ../avaliacao.php');
                } else {
                echo "<script> alert('Serviço de avaliação indisponível, por favor tente novamente mais tarde');</script>";
                echo "<script> console.error('Erro ao salvar prova !');</script>";
                echo "Erro  ".mysqli_errno($con);
                // header ('Location: ../cursos.php');
                }
            }
            
        } else {
            echo "sessão expirada";
        }
        
    ?>
</div>

    
    <script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="../assets/js/materialize.js" type="text/javascript"></script>
    <script src="../assets/js/main.js" type="text/javascript"></script>

</body>
</html>
