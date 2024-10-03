<?php
    $nomeUsuario = $_POST["nome"];
    $emailUsuario = $_POST["email"];
    $senhaUsuario = $_POST["senha"];
    $sexoUsuario = $_POST["sexo"];


    // BANCO DE DADOS
    $dsn = 'mysql:host=127.0.0.1; dbname=consultorio_medico'; // Mudar conforme o necessário
    $usuarioBanco = "root";
    $senhaBanco = "password"; // Mudar conforme o necessário

    if(!(filter_var($emailUsuario, FILTER_VALIDATE_EMAIL))){
        echo "<h1>Digite um email válido</h1>";
        header("Location: cadastro.php?email=erro");
    }

    try {
        $conexao = new PDO($dsn, $usuarioBanco, $senhaBanco);
        
        $query = "INSERT INTO usuario (nome, email, senha, sexo) VALUES (:nome, :email, :senha, :sexo)";
    
       
        $stmt = $conexao->prepare($query);
    
    
        $stmt->bindValue(":nome", $nomeUsuario);
        $stmt->bindValue(":email", $emailUsuario);
        $stmt->bindValue(":senha", $senhaUsuario);
        $stmt->bindValue(":sexo", $sexoUsuario);
    
        $stmt->execute();

        $idUsuario = $conexao->lastInsertId();
        header("Location: usuario_validado.php?id=" . $idUsuario);
    
    } catch (PDOException $e) {
        echo "Erro na inserção: " . $e->getMessage();
    }
    
    

    
?>
