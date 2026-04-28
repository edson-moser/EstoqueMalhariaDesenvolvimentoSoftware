<?php
require 'conexao.php';
session_start();

if (!isset($_POST['login']) || !isset($_POST['senha'])) {
    return;
}

$login = $_POST['login'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM malharia WHERE login = '$login' LIMIT 1";
$result = $conecta->query($sql);


if ($result->num_rows == 0) {

    $check_padrao = $conecta->query("SELECT * FROM malharia WHERE login = 'ilkaconfeccoes'");

    if ($check_padrao->num_rows == 0) {
        $conecta->query("INSERT INTO malharia (login, senha) 
                         VALUES ('ilkaconfeccoes', '12345')");

        echo "Usuário padrão criado!<br>";
        echo "Login: ilkaconfeccoes | Senha: 12345";
    } else {
        echo "Usuário não encontrado!";
    }

    exit;
}


$usuario = $result->fetch_assoc();

if ($senha == $usuario['senha']) {

    $_SESSION['malharia_id'] = $usuario['id'];

    header("Location: TelaEstoque.php");
    exit;

} else {
    echo "Senha incorreta!";
}
?>