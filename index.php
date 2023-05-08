<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendamento Médico</title>
</head>
<body>
    <div class="container-formulario">
        <h1>Agendamento medico</h1>
    <?php
if (isset($_POST['submit'])){
$nome=$_POST['nome'];
$email=$_POST['email'];
$telefone=$_POST['telefone'];
$data=$_POST['data'];
$hora=$_POST['hora'];

$stmt= $pdo->prepare('SELECT count(*)
 FROM agendamentos WHERE data = ? 
 AND hora = ?');
 $stmt->execute([$data, $hora]);
 $count = $stmt->fetchColumn();

 if($count > 0){
    $erro='já existe um agendamento para essa data e horario.';
}
else{
    $stmt = $pdo->prepare('INSERT INTO agendamentos(nome, email, telefone, data, hora)
    VALUES (:nome, :email, :telefone, :data, :hora)');
    $stmt->execute(['nome'=> $nome, 
    'email'=>$email,
    'telefone'=>$telefone, 'data'=> $data, 'hora'=> $hora]);

    if($stmt->rowcount()){
        echo '<span>Compromisso agendamento com sucesso!</span>';
    }else{
        '<span>Erro ao agendar compromisso. tente novamente mais tarde.</span>';
    }
}
if(isset($erro)){
    echo '<span>' . $erro .'</span>';
}
}
?>
<form method="post">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br>
        
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
        
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" required><br>
        
    <label for="data">Data:</label>
    <input type="date" name="data" required><br>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" required><br>
    
    <div>
        <button type="submit" name="submit" value="agendar">Agendar</button>
        <button><a href='listar.php'>Lista</a></button>
        <div>
</form>
    </div>
</body>
</html>