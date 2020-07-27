<?php
$conn = require('connection.php');

$id = $_GET['id'] ?? null;

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
    <title>Ver usuário</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body bgcolor="lightgray">
    
<fieldset class="fieldVer">
<h1><?php echo $user['nome']; ?></h1>
    <p>CPF: <?php echo $user['cpf']; ?></p>
    <p>E-mail: <?php echo $user['email']; ?></p>
    <p>Telefone: <?php echo $user['telefone']; ?></p>
</fieldset>

    <p>
        <a class="btn" href="/crud/editar.php?id=<?php echo $user['id']; ?>">Editar</a>
        <a class="btn" href="/crud/remover.php?id=<?php echo $user['id']; ?>">Remover</a>
    </p>
    <br>
    <p><a class="btn" href="/crud">voltar</a></p>
</body>
</html>