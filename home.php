<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title> Login de usuário com PHP </title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1> Login de usuário e validação de acesso </h1>

  <form action="home.php" method="post">
   <fieldset>
    <legend> Validação de acesso </legend>

    <div>
     <button class="home" name="cadastrar"> Cadastrar usuário </button>
     <button class="home" name="logar"> Logar usuário </button>
    </div>
   </fieldset>
  </form>

  <?php
   if(isset($_POST['cadastrar'])) {
        header("location: cadastro.php");
    }

   if(isset($_POST['logar'])) {
        header("location: login.php");
    }
  ?>
</body>
</html>