<?php 
    session_start();
    require ('../bd/connect.php');
    if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
        $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
        $idAluno = $_SESSION['idAluno'];
        $idCursoParam = $_GET['idCursoParam']; //id do curso via param
        $_SESSION['idCurso'] = $idCursoParam;

        //pesquisa se aluno já faz o curso 

        $query = "SELECT * FROM CURSOS";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // se o aluno já faz algum curso atualiza
            $query = "UPDATE CURSOS SET status_curso='FAZENDO' WHERE id='$idCursoParam' ";
            
            $result = mysqli_query($con, $query);
            
            echo '<script> console.info("Curso escolhido com sucesso !");</script>';
            header ('Location: ../meus-cursos.php');

        } else {
            $query = "UPDATE CURSOS SET status_curso='FAZENDO' WHERE id='$idCursoParam' ";
                   
            if(mysqli_query($con, $query)){
                echo '<script> console.info("Curso escolhido com sucesso  FLUXO DO ELSE!");</script>';
                header ('Location: ../meus-cursos.php');
            } else {
            echo "<script> alert('Serviço de escolha de curso indisponível, por favor tente novamente mais tarde');</script>";
            echo "<script> console.error('Erro ao escolher curso!');</script>";
            echo "Erro  ".mysqli_errno($con);
            // header ('Location: ../cursos.php');
            }
        }
                
       
        
        
      } else {
        echo "sessão expirada";
      }
      
?>