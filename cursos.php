
<!DOCTYPE html>
<html>
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="ALt Technology">
    <meta name="description" content="Portal univesitário">
    <meta name="keywords" content="Portal univesitário">
    
    <link rel="shortcut icon" href="https://www.appdynamics.co.uk/static/img/favicon.ico">
    
    <title>ALL IN ONE | CURSOS</title>

    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/css/main.css" rel="stylesheet"/>

</head>
<body>
      
    <?php 
      include 'menu.php';
      session_start();
      $_SESSION['cursoFeito'] = "NAO";
    ?>
    <div class="container-fluid ">
        
      <div class="row">
          <h2 class="title">
              CURSOS
          </h2>
      </div>

      <ul class="collection">

            <?php
                require ('bd/connect.php');

                if (isset($_SESSION['login'])) {
                    $email = $_SESSION['login'];
                    
                    $query = "SELECT * FROM ALUNOS where email='$email' ";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) == 0) {
                        echo "<script> alert('Dados não encontrados !')</script> ";
                    } else if (mysqli_query($con, $query))  {
                      // listar dados 
                      
                      while ($row = $result->fetch_assoc()) { // alunos
                        $alunoId = $row['id'];

                        $_SESSION['idAluno'] = $alunoId;
                        
                        // $query = "SELECT * FROM CURSOS where id_aluno='$alunoId'";
                        $query = "SELECT * FROM CURSOS WHERE status_curso='FAZER'";
                        $result = mysqli_query($con, $query);

                        while ($row = $result->fetch_assoc()){ // cursos

                          // gravar id_aluno e id_curso na sessão, a ser utilizado em Exolher curso.php
                          $idCurso = $row['id'];
                          $_SESSION['idCurso'] = $idCurso;

                          echo '<li class="collection-item avatar">
                                <div class="row">
                                  <div class="col s12 m3 l6">
                                    <i class="img-curso"> <img src="'.$row['url_image'].'" width="40px" height="40px"></i>
                                    <span class="title">'.$row['nome'].'</span>
                                    <p>Código: '.$row['id'].'</p>
                                  </div>
                      
                                  <div class="col s12 m7 l6 action-buttons">
                                  <a class="waves-effect waves-light btn" href="php/escolherCurso.php?idCursoParam='.$row['id'].'&nomeCursoParam='.$row['nome'].'"><i class="fa fa-paper-plane left"></i>iniciar</a>
                                  </div>
                                </div>
                      
                              </li>';
                          
                          
                        }// fim while curso
                        
                      }
                      // botãoa avaliação criar nova avaliação
                      // removido relacionamento de curso e materiais , materiais fica dentro do curso agora.
                    } else {  
                      echo "Erro  ".mysqli_errno($con);
                    }
                } else {
                  header ('Location: index.php');
                }

              ?>
            
            
        
      
          </ul>
    
    
                
    </div>

    <?php 
      include 'footer.php';
    ?>

    
    <script src="assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="assets/js/materialize.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    
</body>
</html>
