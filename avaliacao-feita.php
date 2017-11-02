
<!DOCTYPE html>
<html>
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="ALt Technology">
    <meta name="description" content="Portal univesitário">
    <meta name="keywords" content="Portal univesitário">
    
    <link rel="shortcut icon" href="https://www.appdynamics.co.uk/static/img/favicon.ico">
    
    <title>ALL IN ONE | AVALIAÇÃO FEITA</title>
    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/css/main.css" rel="stylesheet"/>

</head>
<body>
    <?php 
    session_start();
    include ('menu.php'); 
      
    ?>
    <!-- ao selecionar uma avaliação FAZ INSERT  do id_aluno && id_curso na tabela ALUNO_CURSO 
        quando pressionar em salvar fará um insert na tabela TENTATIVAS  que relaciona tudo;
        * não preciso ter o id do aluno na tabela PROVA
        * id_curso representa curso atual adiconar botão que mostra o curso atual;
    -->
 
  <div class="container">

  
    <div class="row">
            <h2 class="title">
                CURSO  <?php 
                            if(isset($_SESSION['nomeCurso'])){
                                echo " | ".$_SESSION['nomeCurso'];     
                            } else {
                                echo " | ". $_GET['idCursoParam'];
                            }
                        
                        ?>
            </h2>
    </div>
   <div class="row">
		<form method="POST">

              <?php 
                require ('bd/connect.php');
                        
                if (isset($_SESSION['login'])) {
                     // valores recebido via queryParams

                    //href="avaliacao-feita.php?
                    //idCursoParam='.$row['id_curso'].'
                    //&notaParam='.$row['nota'].'
                    //&idAlunoParam='$row['id_aluno']'
                    //&idProvaParam='.$row['id_prova'].' ">

                    $idCurso = $_GET['idCursoParam'];
                    $idAluno = $_GET['idAlunoParam'];
                    $idProva = $_GET['idProvaParam'];
                    $nota = $_GET['notaParam'];

                    $query = "SELECT * FROM TENTATIVAS where id_curso='$idCurso' and id_aluno='$idAluno' and id_prova='$idProva' ";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) === 0) {
                        echo "<script> alert('Dados não encontrados !')</script> ";
                        echo "<h1>Dados não encntrados ID do curso: ".$idCurso."</h1>";
                    } else if (mysqli_query($con, $query))  {
                        while ($row = $result->fetch_assoc()){ // provas
                        // REF: https://www.devmedia.com.br/trabalhando-com-json-em-php/26716   
                        // array de multiplos objetos
                        // $json_str = $row['questoes'];    
                        // faz o parsing da string , criando o array questoes
                        //$jsonObj = json_decode($json_str);
                        //$questoes = $jsonObj ->questoes;
                        //navega pelos elementos do array, imprimindo cada questão

                        // foreach($questoes as $q){
                        //     echo "id: ".$q ->id." descricao: ".$q ->descricao."pergunta: ".$q ->pergunta."<br>";
                        // }
                        
                        $json_str = $row['questoes'];    
                        // faz o parsing da string , criando o array questoes
                        $jsonObj = json_decode($json_str);
                        $questoes = $jsonObj ->questoes;

                       
                            echo '<div class="fixed-action-btn">
                                    <a class="btn btn-large">
                                        NOTA: '.$nota.'
                                    </a>
                                </div>';

                            foreach($questoes as $q){
                                
                                echo '<div class="col s12">
                                    <div class="card questao-avaliacao">
                                        <span class="card-title questao-title">
                                            QUESTAO -'.$q ->id.'
                                        </span>
                                        <div class="card-content questao-conteudo">
                                            
                                            <div class="questa-pergunta">
                                                <br>
                                                '.$q ->descricao.'
                                                <br>
                                            </div>
                                            <div class="input-field questao-resposta">
                                                <select name="resposta'.$q ->id.'" disabled>
                                                <option selected> '.$q->resposta.' </option>
                                               
                                                </select>
                                            <label>você respondeu</label>
                                        </div>
                                        </div>
                                    </div>
                                    </div>';
                            }
                            
                        }// fim while prova
                        
                    } else {  
                        echo "Erro  ".mysqli_errno($con);
                    }
                }

              ?>
     
              <a href="meu-perfil.php" class="btn"> Voltar</a>

        </form>
      </div>
    
    </div>

   <?php 
    include 'footer.php';
   ?>
    
    <script src="assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="assets/js/materialize.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    
</body>
</html>
