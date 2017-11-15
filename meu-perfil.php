<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="author" content="ALt Technology">
  <meta name="description" content="Portal univesitário">
  <meta name="keywords" content="Portal univesitário">

  <link rel="shortcut icon" href="https://www.appdynamics.co.uk/static/img/favicon.ico">

  <title>ALL IN ONE | MEU PERFIL</title>

  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <link href="assets/css/main.css" rel="stylesheet" />

  <!-- Adicionando Javascript -->
  <script type="text/javascript">
    function limpa_formulário_cep() {
      //Limpa valores do formulário de cep.
      document.getElementById('rua').value = ("");
      document.getElementById('bairro').value = ("");
      document.getElementById('cidade').value = ("");
      document.getElementById('uf').value = ("");
      document.getElementById('ibge').value = ("");
    }

    function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
        document.getElementById('ibge').value = (conteudo.ibge);
      } //end if.
      else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        console.error("CEP não encontrado.");
      }
    }

    function pesquisacep(valor) {

      //Nova variável "cep" somente com dígitos.
      var cep = valor.replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          document.getElementById('rua').value = "...";
          document.getElementById('bairro').value = "...";
          document.getElementById('cidade').value = "...";
          document.getElementById('uf').value = "...";
          document.getElementById('ibge').value = "...";

          //Cria um elemento javascript.
          var script = document.createElement('script');

          //Sincroniza com o callback.
          script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

          //Insere script no documento e carrega o conteúdo.
          document.body.appendChild(script);

        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    };
  </script>

</head>

<body>

  <?php    
    include 'menu.php';
    session_start();

  ?>
  <div class="banner-perfil"> </div>


  <div class="container-fluid">

    <!-- visualização do perfil -->
    <div  class="containaer-visualizar-perfil" id="container-visualizar-perfil">

      <div class="row">
        <div class="col s12 m6">
          <div class="card">

            <span class="card-title">MEU PERFIL <i class="fa fa-edit btn-close-perfil"></i></span>
            <br>
            

            <div class="card-content">

              <?php
                  require ('bd/connect.php');

                  if (isset($_SESSION['login'])) {
                      $email = $_SESSION['login'];
                      
                      $query = "SELECT * FROM ALUNOS where email='$email'";
                      $result = mysqli_query($con, $query);
                      
                      if (mysqli_num_rows($result) == 0) {
                          echo "<h2> Você ainda não preencheu seu perfil</h2>";
                      } else if (mysqli_query($con, $query))  {
                        // listar dados 
                        while ($row = $result->fetch_assoc()) {

                          echo "<label>Nome: ".$row['nome']."</label> </br>";
                          echo "<label>CPF: ".$row['cpf']."</label> </br>";
                          echo "<label>Cidade Natal: ".$row['cidade_natal']."</label> </br>";
                          echo "<label>Data de nascimento: ".$row['data_nascimento']."</label> </br>";
                          echo "<label>Sexo: ".$row['sex']."</label> </br>";

                        }


                      } else {  
                        echo "Erro  ".mysqli_errno($con);
                      }
                  } else {
                    header ('Location: index.php');
                  }

                ?>

              

            </div>
          </div>
        </div>

        <div class="col s12 m6">
          <div class="card">
            <span class="card-title">MEU ENDEREÇO   <i class="fa fa-map-marker"></i></span>
            <br>
            
            <div class="card-content">
              <?php
                  require ('bd/connect.php');

                  if (isset($_SESSION['login'])) {
                      $email = $_SESSION['login'];
                      
                      $query = "SELECT * FROM ALUNOS where email='$email'";
                      $result = mysqli_query($con, $query);
                      
                      if (mysqli_num_rows($result) == 0) {
                        echo "<h2> Você ainda não preencheu seu endereço.</h2>";
                      } else if (mysqli_query($con, $query))  {
                        // listar dados 
                        while ($row = $result->fetch_assoc()) {

                          echo "<label>Cep: ".$row['cep']."</label> </br>";
                          echo "<label>Rua: ".$row['endereco']."</label> </br>";
                          echo "<label>Bairro: ".$row['bairro']."</label> </br>";
                          echo "<label>Cidade: ".$row['cidade']."</label> </br>";
                          echo "<label>Estado: ".$row['estado']."</label> </br>";

                        }


                      } else {  
                        echo "Erro  ".mysqli_errno($con);
                      }
                  }

                ?>

            </div>
          </div>
        </div>

      </div>

      <div class="fixed-action-btn horizontal">
        <a class="btn-floating btn-large red btn-toggle-perfil">
          <i class="large fa fa-pencil"></i>
        </a>
      </div>

    </div>
    <!-- fim visualizar perfil -->
    
    <!-- editar perfil -->
    <div id="container-editar-perfil">
      <form method="POST">  
        <div class="row">
          <div class="col s12 m6">
            <div class="card">

              <span class="card-title">MEU PERFIL   <i class="fa fa-times btn-toggle-perfil"></i></span>
              <br>
              

              <div class="card-content">
              <!-- pegar dados para  popular no form de edição -->
              <?php
                  require ('bd/connect.php');

                  if (isset($_SESSION['login'])) {
                      $email = $_SESSION['login'];
                      
                      $query = "SELECT * FROM ALUNOS where email='$email'";
                      $result = mysqli_query($con, $query);
                      
                      if (mysqli_num_rows($result) == 0) {
                          echo "<h2> Você ainda não preencheu seu perfil</h2>";
                      } else if (mysqli_query($con, $query))  {
                        // listar dados 
                        while ($row = $result->fetch_assoc()) {
               
                          echo "<label for='nome'>Nome</label> 
                                <input type='text' name='nome' value=".$row['nome']." required> <br>

                                <label for='cpf'>CPF</label>
                                <input type='text' placeholder='cpf' name='cpf' value=".$row['cpf']." required> <br>

                                <label for='cidadeNatal'>Cidade Natal</label>
                                <input type='text' placeholder='cidade natal' name='cidadeNatal' value=".$row['cidade_natal']." required> <br>
              
                                <br>
                                <label for='dataNascimento'>Data de nascimento</label>
                                <input type='date' placeholder='data de nacimento' name='dataNascimento' value=".$row['data_nascimento']." required> <br>
                                <br>
              
                                <div class='input-field col s12 m12'>
                                  <select name='sexo' required>
                                    <option value=".$row['sex']."  selected> " .$row['sex']. "</option>
                                    <option value='masculino'>masculino</option>
                                    <option value='feminino'>feminino</option>
                                    <option value='outros'>outros</option>
                                    <option value='indefinido'>indefinido</option>
                                    <option value='gosto'>gosto</option>
                                  </select>
                                  <label>Sexo</label>
                                </div>
              
                             
              
                                <br>
                                <br>
                                <br>
                                <br>
                                
                                "; // fim echo dados  

                        }


                      } else {  
                        echo "Erro  ".mysqli_errno($con);
                      }
                  }

                ?>

              </div>
            </div>
          </div>

          <div class="col s12 m6">
            <div class="card">
              <span class="card-title">MEU ENDEREÇO   <i class="fa fa-map-marker"></i></span>
              <br>
              
              <div class="card-content">
              <?php
                  require ('bd/connect.php');

                  if (isset($_SESSION['login'])) {
                      $email = $_SESSION['login'];
                      
                      $query = "SELECT * FROM ALUNOS where email='$email'";
                      $result = mysqli_query($con, $query);
                      
                      if (mysqli_num_rows($result) == 0) {
                          echo "<h2> Você ainda não preencheu seu perfil</h2>";
                      } else if (mysqli_query($con, $query))  {
                        // listar dados 
                        while ($row = $result->fetch_assoc()) {
               
                          echo "  <label>Cep: (para atualizar o endereço preencha o cep)
                                  <input name='cep' type='text' id='cep' value=".$row['cep']." size='10' maxlength='9'
                                              onblur='pesquisacep(this.value);' required />
                                  </label><br />

                                  <label>Rua:
                                        <input name='rua' type='text' id='rua' size='60'  required/></label><br />
                                  <label>Bairro:
                                        <input name='bairro' type='text' id='bairro' size='40'  required/></label><br /><br>
                                  <label>Cidade:
                                        <input name='cidade' type='text' id='cidade' size='40'  required /></label><br />
                                  <label>Estado:
                                        <input name='uf' type='text' id='uf' size='2' value=".$row['estado']." required /></label>
                                  <input name='ibge' type='hidden' id='ibge' size='8'  required /></label><br />
                                
                                "; // fim echo dados  

                        }


                      } else {  
                        echo "Erro  ".mysqli_errno($con);
                      }
                  }

                ?>
                
                  <!-- <label>Cep:
                        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
                              onblur="pesquisacep(this.value);" required />
                    </label><br />
                  <label>Rua:
                        <input name="rua" type="text" id="rua" size="60" required/></label><br />
                  <label>Bairro:
                        <input name="bairro" type="text" id="bairro" size="40" required/></label><br /><br>
                  <label>Cidade:
                        <input name="cidade" type="text" id="cidade" size="40" required /></label><br />
                  <label>Estado:
                        <input name="uf" type="text" id="uf" size="2" required /></label>
                  <input name="ibge" type="hidden" id="ibge" size="8" required /></label><br /> -->
                  
                
              </div>
            </div>
          </div>

         
        </div>  


        <div class="fixed-action-btn">
          <a class="btn-floating btn-large green">
            <i class="large fa fa-pencil"></i>
          </a>
          <ul>
            <li><a class="btn-floating green"><input type="submit" name="atualizarPerfil" style="background:#4CAF50;color:#fff;font-size:14px;" value="OK"></a></li>
            <li><a class="btn-floating red btn-toggle-perfil"><i class="fa fa-times"></i></a></li>
            
          </ul>
        </div>
      
        <?php
            require ('bd/connect.php');
            if (isset($_POST['atualizarPerfil'])) {
                $email = $_SESSION['login'];
                $nome = $_POST['nome'];
                $sexo = $_POST['sexo'];              
                $cpf = $_POST['cpf'];

                $dataNascimento = $_POST['dataNascimento'];
                $cidadeNatal = $_POST['cidadeNatal'];
                

                
                $query = "SELECT * FROM ALUNOS where email='$email'";
                $result = mysqli_query($con, $query);
                
                if (mysqli_num_rows($result) == 0) {
                    echo "<script> alert('Esse usuário já existe')</script> ";
                } else {
                    // update records
                    $query = "UPDATE ALUNOS SET nome ='$nome', sex ='$sexo', cpf ='$cpf', data_nascimento ='$dataNascimento', cidade_natal ='$cidadeNatal' WHERE email = '$email' ";
                            
                    
                    if (mysqli_query($con, $query)) {
                        echo "<script> alert('Perfil atualizado com sucesso !');</script> ";
                        
                    } else {
                        echo "Erro  ".mysqli_errno($con);
                        echo "<script> alert('Erro ao atualizar perfil, por favor , tente novamente !')</script> ";
                    }
                }
            }
        
          ?>
          <!-- TODO editar perfila add AJAX , agrupar num unico script -->
          <?php
                require ('bd/connect.php');
                if (isset($_GET['atualizarPerfil']) or isset($_POST['cpf'])) {
                    // session_start();

                    $email = $_SESSION['login'];
                    
                    //endereco
                    $cep  = $_POST['cep']; //incluir db
                    $bairro = $_POST['bairro']; //incluir db
                    $endereco  = $_POST['rua'];
                    $cidade  = $_POST['cidade'];
                    $estado  = $_POST['uf'];
                    
                    $query = "SELECT * FROM ALUNOS where email='$email'";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) == 0) {
                        echo "<script> alert('Esse usuário já existe')</script> ";
                    } else {
                        // update records
                        $query = "UPDATE ALUNOS SET  endereco ='$endereco', cidade ='$cidade',estado ='$estado', cep='$cep', bairro='$bairro' WHERE email = '$email' ";
                                
                        
                        if (mysqli_query($con, $query)) {
                          echo "<script> console.info('Endereço atualizado com sucesso !')</script> ";
                            
                        } else {
                            echo "Erro  ".mysqli_errno($con);
                            echo "<script> console.error('Erro ao atualizar endereço, por favor , tente novamente !')</script> ";
                        }
                    }
                }
            
              ?>
                  


                  
      </form>
    </div>
    <!-- fim visualizar perfil -->

    <!--  lista de avaliações -->

    <div class="row">
     <div class="col s12 m12">
      <div class="card">

          <span class="card-title avaliacao-title">MINHAS AVALIAÇÕES</span>
          <br><br><br>
        
          <ul class="collection">
                <!--  incluir nome -->
            <?php
                require ('bd/connect.php');
                #BUG DADOS DA SESSÃO ESTÃO REPLICANDO
                if (isset($_SESSION['login'])) {
                    $email = $_SESSION['login'];
                    
                    $query = "SELECT * FROM ALUNOS where email='$email'";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) === 0) {
                      echo '<li class="collection-item avatar">
                              <div class="row">
                                <div class="col s12 m3 l6">
                                  <p>Não foram encontradas avaliações</p>
                                </div>
                              </div>
                            </li>';
                      echo "<script> console.info('sem avaliaçãoes encontradas');</script>";
                    } else if (mysqli_query($con, $query))  {
                      // listar dados 
                      
                      while ($row = $result->fetch_assoc()) { // alunos
                        $alunoId = $row['id'];

                        $query = "SELECT * FROM TENTATIVAS where id_aluno='$alunoId'";
                        
                        $result = mysqli_query($con, $query);

                        while ($row = $result->fetch_assoc()){ // tentativas
                          
                          
                          if(isset($_SESSION['nomeCurso'])){
                            $nomeCurso = $_SESSION['nomeCurso'];     
                          } else {
                            $nomeCurso = $row['id_curso'];
                          }
                          
                          
                          echo '<li class="collection-item avatar">
                                <div class="row">
                                  <div class="col s12 m3 l6">
                                    <i class="fa fa-file circle"></i>
                                    <span class="title"> curso: '.$nomeCurso.'</span>
                                    <p>Data:'.$row['data'].' <br>
                                    Nota: '.$row['nota'].'
                                    </p>
                                  </div>
                      
                                  <div class="col s12 m7 l6 action-buttons">
                                    <a class="waves-effect waves-light btn" href="avaliacao-feita.php?idCursoParam='.$row['id_curso'].'&notaParam='.$row['nota'].'&idAlunoParam='.$row['id_aluno'].'&idProvaParam='.$row['id_prova'].' "><i class="fa fa-paper left"></i>ver avaliação</a>
                                  </div>
                                </div>
                      
                              </li>';
                        }
                        
                      }


                    } else {  
                      echo "Erro  ".mysqli_errno($con);
                    }
                }

              ?>
            
            
        
      
          </ul>
              
        </div>
      </div>
        
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