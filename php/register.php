<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "overclock_zone";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

 
    if ($password !== $confirm_password) {
        echo "<script>alert('As senhas não coincidem.'); window.location.href='register.html';</script>";
        exit();
    }

 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        echo "<script>alert('E-mail já cadastrado! Tente outro.'); window.location.href='register.html';</script>";
        exit();
    }

  
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar. Tente novamente.'); window.location.href='register.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
