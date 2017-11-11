
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
                CURSO <?php echo $_SESSION['nomeCurso'] ?>
            </h2>
            <div class="col s12">
                <p> * você pode deixar questões em branco ,porém recomendamos que preencha todas</p>
            </div>
            
    </div>
   <div class="row">
		<form method="POST" action="php/salvarAvaliacao.php">

              <?php 
                require ('bd/connect.php');
                        
                if (isset($_SESSION['login'])) {
                    
                    $idCurso = $_SESSION['idCurso'];

                    $query = "SELECT * FROM PROVAS where id_curso='$idCurso' ORDER BY id ";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) === 0) {
                        echo "<script> alert('Dados não encontrados !')</script> ";
                        echo "<h1>ID do curso: ".$idCurso."</h1>";
                    } else if (mysqli_query($con, $query))  {
                        while ($row = $result->fetch_assoc()){ // provas
                        // REF: https://www.devmedia.com.br/trabalhando-com-json-em-php/26716   
                        // array de multiplos objetos
                        $json_str = $row['questoes'];    
                        // faz o parsing da string , criando o array questoes
                        $jsonObj = json_decode($json_str);
                        $questoes = $jsonObj ->questoes;

                        // obj simples
                        //REF: http://php.net/manual/pt_BR/function.json-decode.php  Exemplo #2 Um outro exemplo
                        //  $json = $row['questoes'];
        
                        //  $obj = json_decode($json);

                        //  echo $obj->{'id'}."<br>";
                        //  echo $obj->{'descricao'}."<br>";
                        //  echo $obj->{'pergunta'}."<br>";

                        $_SESSION['idProva'] = $row['id']; // pega o id da prova e armazena na sessão

                        // $json_strResposta = $row['respostas'];    
                        // // faz o parsing da string , criando o array de respostas

                        // $jsonObjResposta = json_decode($json_strResposta);
                        // $respostas = $jsonObjResposta ->respostas;

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
                                                <select id="resposta'.$q ->id.'"  name="resposta'.$q ->id.'">
                                                <option value="" >DEIXAR EM BRANCO</option>
                                                <option value="SIM">SIM</option>
                                                <option value="NAO" selected>NÃO</option>
                                                </select>
                                            <label>resposta</label>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
                                    // armazena as resposta selecionadas na session, porém está sendo utilizado $_POST   apenas o salvarAvaliacao;
                                    
                                    //$q ->resposta = $_SESSION['respostaValor'.$q ->id];    

                        }// fim for each provas
                        
                      
                    }  // fim while prova
                } // fim if mysqli query
              } else {
                echo "Erro  ".mysqli_errno($con);
              } // fim idLogin
              ?>
          
                    
            <input type="submit" value="salvar" name="salvarAvaliacao" class="btn btn-submit">

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
