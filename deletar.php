<?php
include 'db.php';

if(!isset($_GET['id'])){
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM agendamentos WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$stmt =$pdo->prepare('SELECT * FROM agendamentos WHERE id = ?');
$stmt->execute([$id]);
header('location:listar.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Deletar compromisso</title>
</head>
<body>
<h1>Deletar compromisso</h1>
<p>tem certeza que deseja deletaro compromisso de
    <?php echo $appointment['nome']; ?> 
em <?php echo date('d/m/y',strtotime($appointment['data'])); ?>
ás <?php echo date('H:i',strtotime($appointment['hora'])); ?></p>   
<form method="post">
    <button type="submit">sim</button>
    <a href="listar.php">Não</a>
</form>
</body>
</html>