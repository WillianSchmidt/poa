<?php

include('database_functions.php');

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
