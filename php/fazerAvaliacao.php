<?php 
    session_start();
    require ('../bd/connect.php');
    if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
        $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
        $idAluno = $_SESSION['idAluno'];
        
        $idCursoParam = $_GET['idCursoParam']; //id do curso via param
        $_SESSION['idCurso'] = $idCursoParam;

        $nomeCursoParam = $_GET['nomeCursoParam'];
        $_SESSION['nomeCurso'] = $nomeCursoParam;
        //pesquisa se aluno já faz o curso 

        $query = "SELECT * FROM PROVAS where id_curso='$idCursoParam'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // se o aluno já faz algum curso atualiza
            $query = "UPDATE PROVAS SET id_curso = '$idCursoParam' ";
            echo '<script> console.info("Prova atualizada com sucesso !");</script>';
            header ('Location: ../avaliacao.php');

        } else {
            // senão insere um novo
            $query = "INSERT INTO PROVAS (id_curso) VALUES ('$idCursoParam')";
                   
            if(mysqli_query($con, $query)){
                echo '<script> console.info("Prova criada com sucesso !");</script>';
                header ('Location: ../avaliacao.php');
            } else {
            echo "<script> alert('Serviço de avaliação indisponível, por favor tente novamente mais tarde');</script>";
            echo "<script> console.error('Erro ao criar prova !');</script>";
            echo "Erro  ".mysqli_errno($con);
            // header ('Location: ../cursos.php');
            }
        }
                
       
        
        
      } else {
        echo "sessão expirada";
      }
      
?>