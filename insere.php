<?php

include('database_functions.php');

	$pdo = connect_to_database("mysql");

	$sql = "CREATE DATABASE IF NOT EXISTS falacidadebaixa ";
    $pdo->exec($sql);

	$pdo = null;
	
	$pdo = connect_to_database('falacidadebaixa');
	
    $sql = "CREATE TABLE IF NOT EXISTS  Denuncias (".
               "nome varchar(100) NOT NULL,".
			   "email varchar(100) NOT NULL,".
			   "comments varchar(500) NOT NULL,".
               "PRIMARY KEY (nome))";

    $pdo->exec($sql);
		
	$sql = "CREATE TABLE IF NOT EXISTS  compras (".
               "nome varchar(50) NOT NULL,".
			   "email varchar(50) NOT NULL,".
			   "endereco varchar(50) NOT NULL,".
			   "cidade varchar(50) NOT NULL,".
			   "estado varchar(50) NOT NULL,".
			   "cep varchar(9) NOT NULL,".
			   "nomecard varchar(50) NOT NULL,".
			   "numerocard varchar(20) NOT NULL,".
			   "mescard int NOT NULL,".
			   "anocard int NOT NULL,".
			   "cvvcard int NOT NULL,".
			   "valor float NOT NULL,".
               "PRIMARY KEY (nome))";

    $pdo->exec($sql);

	$pdo = null;
	
	if (!isset($_POST['nome'])) {
    echo "<p>Um nome é necessário.</p>";
    exit();
}
	
$nome = $_POST['nome'];
$email = $_POST['email'] == "" ? NULL : $_POST['email'];
$comments = $_POST['comments'] == "" ? NULL : $_POST['comments'];

$pdo = connect_to_database("falacidadebaixa");

$sql_search = "SELECT nome FROM denuncias WHERE nome = :nome";
$stmt_search = $pdo->prepare($sql_search);

$sql_ins = "INSERT INTO denuncias (nome, email, comments) VALUES(:nome, :email, :comments)";
$stmt_ins = $pdo->prepare($sql_ins);

$sql_upd = "UPDATE denuncias SET email = :email, comments = :comments WHERE nome = :nome";
$stmt_upd = $pdo->prepare($sql_upd);

try {
    if ($stmt_search->execute(array(":nome"=>$nome))) {
        $dados = array(
            ":nome" => $nome,
            ":email" => $email,
            ":comments" => $comments
        );
        if ($stmt_search->rowCount() > 0) {
            $stmt_upd->execute($dados);
        } else {
            $stmt_ins->execute($dados);
        }
        header("Location: lista.php");
    } else {
        echo "<p>Got no SEARCH results...</p>";
        echo "<p>Erro no SEARCH.</p>";
        exit();
    }
} catch (Exception $e) {
  echo "ERROR: ".$e->getMessage()."\n";
  exit('\nOooops...');
}

?>
