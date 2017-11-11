
<!DOCTYPE html>
<html>
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="author" content="ALt Technology">
    <meta name="description" content="Portal univesitário">
    <meta name="keywords" content="Portal univesitário">
    
    <link rel="shortcut icon" href="https://www.appdynamics.co.uk/static/img/favicon.ico">
    
    <title>ALL IN ONE</title>

    <link href="assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="assets/css/main.css" rel="stylesheet"/>

</head>
<body>
    
    <nav class="navbar navbar-home">
  
      <div class="navbar-container">
        
        <div class="brand">
            <img src="assets/img/all-in-one-logo.png" alt="logo"></img>
        </div>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link btn-login"><i class="fa fa-rocket" aria-hidden="true"></i> Logar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn-cadastrar"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastre-se</a>
          </li>
          
         
        </ul>
      </div>
    </nav>
    <!-- exemplo slider-->
    <div class="banner btn-login">
        <div class="banner-item banner-01">
           <h1>ALL IN ONE</h1>
           <h2>tudo em um só lugar</h2>
        </div>
    </div>
    

    <footer>
       <p> &copy ALL IN ONE |  2017 </p>
    </footer>
    
    <!-- Modal -->
    <div id="modalLogin" class="modal-all modal-form">
      <div class="modal-dialog-all ">
    
        <!-- Modal content-->
        <div class="modal-content-all small">
          <div class="modal-header-all">
            <h4 class="modal-title-all">LOGIN</h4>
          </div>
          <form method="POST">
            <div class="modal-body-all">
              
              <input type="email" placeholder="* e-mail" name="email" required>
              <input type="password" placeholder="* password" name="password" required>
              <input type="submit" class="btn btn-submit" value="login"></input>
              <!-- php de login -->
              <?php
                session_start();
                require('bd/connect.php');

                if (isset($_POST['email'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // $password = hash ("sha512", $_POST['password']);

                    $query = "SELECT * FROM tentativas_login where email='$email'"
                            . "and datahora between "
                            . "current_timestamp-30 and current_timestamp";
                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) < 5) {

                        $query = "SELECT * from ALUNOS where email='$email'"
                                . "and password='$password'";

                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $_SESSION["texto"] = "abcdef";
                                
                                $idAluno = $row['idAluno'];
                                
                                $_SESSION['login'] = $email;
                                $_SESSION['idAluno'] = $idAluno;

                                $login = $_SESSION['login'];

                                if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
                                  $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
                                  echo "<script> console.info('Bem vindo ! '.$login);</script>"; // boa vindas
                                  // echo $login;

                                } else {
                                  echo "<script>console.error('usuario sem permissão');</script>"; // negar acesso
                                }
                            }
                          
                          
                          header ('Location: cursos.php');
                        } else {
                            $query = "INSERT INTO tentativas_login(email) values ('$email')";
                            mysqli_query($con, $query);
                            $query = "SELECT * FROM tentativas_login where email='$email'"
                                    . "and datahora between "
                                    . "current_timestamp-30 and current_timestamp";
                            $result = mysqli_query($con, $query);
                            echo mysqli_num_rows($result) . " tentativas "
                            . "realizadas nos ultimos 30s";
                            //header ('Location: index.php');
                            echo "<script>alert('usúario ou senha inválidos, tente novamente !') </script>";
                            echo "Erro  ".mysqli_errno($con);
                        }
                    } else {
                        echo "<br>Número de tentativas excedido";
                        echo "<script>alert('Número de tentativas excedido !') </script>";
                        // header ('Location: index.php');
                    }
                }
                ?>




            </div>
            <div class="modal-footer-all">
              <button type="button" class="waves-effect waves-light btn btn-cancelar red pull-left">cancelar</button>
              <button type="button" class="waves-effect waves-light btn btn-cadastrar">cadastrar</button>
            </div>
            
            
            
          </form>
        </div>
    
      </div>
    </div>
    
    <!-- Modal -->
    <div id="modalCadastro" class="modal-all modal-form">
      <div class="modal-dialog-all ">
    
        <!-- Modal content-->
        <div class="modal-content-all small">
          <div class="modal-header-all">
            <h4 class="modal-title-all">CADASTRE-SE</h4>
          </div>
          <form method="POST">
            <div class="modal-body-all">
              
              <input type="email" placeholder="* e-mail" name="emailCadastro" required>
              <input type="password" placeholder="* password" name="passwordCadastro" required>
              <input type="password" placeholder="* confirme a password" name="confirmacaopassword" required>
            </div>
            <div class="modal-footer-all">
              <button type="button" class="waves-effect waves-light btn btn-cancelar red pull-left">cancelar</button>
              <button type="submit" class="waves-effect waves-light btn btn-cadastrar">cadastrar</button>
            </div>

            <?php
            require ('bd/connect.php');
            if (isset($_POST['emailCadastro']) and isset($_POST['passwordCadastro'])) {
                $email = $_POST['emailCadastro'];
                $passwordCadastro = $_POST['passwordCadastro'];
               
                $query = "SELECT * FROM ALUNOS where email='$email'";
                $result = mysqli_query($con, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<script> alert('Esse usuário já existe')</script> ";
                } else {
                    $query = "INSERT INTO ALUNOS(email,password)"
                            . "VALUES ('$email', '$passwordCadastro')";
                    
                    if (mysqli_query($con, $query)) {

                        $_SESSION['login'] = $email;
                      
                        $login = $_SESSION['login'];

                        if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
                          $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
                          echo "<script> console.info('Bem vindo ! '.$login);</script>"; // boa vindas
                        } else {
                          echo "<script>console.error('usuario sem permissão');</script>"; // negar acesso
                        }
                        header ('Location: meu-perfil.php');
                    } else {
                        echo "Erro  ".mysqli_errno($con);
                        echo "<script> alert('Erro, tente novamente !')</script> ";
                        header ('Location: index.php');
                    }
                }
            }
        
          ?>
            
          </form>
          
         
        </div>
    
      </div>
    </div>
    
    <script src="assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="assets/js/materialize.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>


  
</body>
</html>
