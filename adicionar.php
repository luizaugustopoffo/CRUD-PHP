<?php
$aviso = "Insira um nome, cpf e uma forma de contato (E-mail ou telefone).";
$cpf = "";
$nome = "";
$email = "";
$telefone = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = require('connection.php');

    $cpf = $_POST['cpf'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;

    if($cpf != null && $nome != null && ($email != null || $telefone != null)){
    
        $stmt = $conn->prepare('INSERT INTO users (cpf, nome, email, telefone) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $cpf, $nome, $email, $telefone);
        $stmt->execute();

        header('location: /crud');
        die();
    } else {
        $aviso = "Por favor, insira um nome, cpf e um email ou telefone!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body bgcolor="lightgray">
   <fieldset>
   <h1>Adicionar usuário</h1>

    <form action="/crud/adicionar.php" method="post">
        <label for="">CPF</label><br>
        <input class="campoTexto" type="text" name="cpf" value=<?php echo $cpf ?>><br><br>
        <label for="">Nome</label><br>
        <input class="campoTexto" type="text" name="nome" value=<?php echo $nome ?>><br><br>
        <label for="">E-mail</label><br>
        <input class="campoTexto" type="text" name="email" value=<?php echo $email ?>><br><br>
        <label for="">Telefone</label><br>
        <input class="campoTexto" type="text" name="telefone" value=<?php echo $telefone ?>><br><br>
        <label for=""><?php echo  $aviso ?></label><br><br><br>
        <input class="enviar" type="submit" value="Enviar">
    </form>
   </fieldset>

    <p><a class="btn" href="/crud">voltar</a></p>
</body>
</html>