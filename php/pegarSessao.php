
<?php 

session_start(); // inicia a sessão
//$login = $_POST['email'];
if(isset($_SESSION['login'])){ // verificar se existe a variavel $_SESSION['login']
  $login = $_SESSION['login']; // passa o valor da variavel de sessão para a local
  echo $login;
} else {
  echo "null";
}

?>  