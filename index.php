<?php

$conn = require 'connection.php';

$result = $conn->query('SELECT * FROM users ORDER BY nome ASC;');
$users = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista Usuários</title>
    <link rel="stylesheet" href="crud//styles.css">
</head>
<body bgcolor="lightgray">
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>   
                <th>Nome</th>
                <th>Visualizar Informações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nome']; ?></td>
                <td>
                    <a class="ver" href="/crud/ver.php?id=<?php echo $user['id']; ?>">Ver Dados</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <p><a class="btn" href="/crud/adicionar.php">Adicionar</a></p>
</body>
</html>