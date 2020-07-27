<?php
$conn = require('connection.php');
$id = $_GET['id'] ?? null;
$aviso = "Lembre-se de definir um nome, cpf e uma forma de contato (E-mail ou telefone).";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'] ?? null;
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;

    if($cpf != null && $nome != null && ($email != null || $telefone != null)){
        
        $stmt = $conn->prepare('UPDATE users SET cpf=?, nome=?, email=?, telefone=? WHERE id=?');
        $stmt->bind_param('ssssi', $cpf, $nome, $email, $telefone, $id);
        $stmt->execute();
    
        header('location: /crud');
        die();
    } else {
        $aviso = "Por favor, insira um nome, cpf e um email ou telefone!";
    }
}

$stmt = $conn->prepare('SELECT * FROM users WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body bgcolor="lightgray">
    <fieldset>
    <h1>Editar usuário</h1>

    <form action="/crud/editar.php?id=<?php echo $user['id']; ?>" method="post">
        <label for="">CPF</label><br>
        <input class="campoTexto" type="text" name="cpf" value="<?php echo $user['cpf']; ?>"><br><br>
        <label for="">Nome</label><br>
        <input class="campoTexto" type="text" name="nome" value="<?php echo $user['nome']; ?>"><br><br>
        <label for="">E-mail</label><br>
        <input class="campoTexto" type="text" name="email" value="<?php echo $user['email']; ?>"><br><br>
        <label for="">Telefone</label><br>
        <input class="campoTexto" type="text" name="telefone" value="<?php echo $user['telefone']; ?>"><br><br>
        <label for=""><?php echo  $aviso ?></label><br><br>
        <input class="enviar" type="submit" value="Enviar">
    </form>
    </fieldset>

    <p><a class="btn" href="/crud">voltar</a></p>
</body>
</html>