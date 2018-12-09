<?php

include('database_functions.php');

if (!isset($_POST['firstname'])) {
    echo "<p>Um nome é necessário.</p>";
    exit();
}

$firstname = $_POST['firstname'];  
$email= $_POST['email'];
$adr= $_POST['address']; 	  
$city= $_POST['city']; 	  
$state= $_POST['state']; 	  
$zip= $_POST['zip'];	  
$cname= $_POST['cardname']; 	  
$ccnum= $_POST['cardnumber'];	  
$expmonth= $_POST['expmonth']; 
$expyear= $_POST['expyear'];  
$cvv= $_POST['cvv'];      
$price = 9.90;

$pdo = connect_to_database("falacidadebaixa");

$sql_search = "SELECT nome FROM compras WHERE nome = :firstname";
$stmt_search = $pdo->prepare($sql_search);

$sql_ins = "INSERT INTO compras (nome, email, endereco, cidade, estado, cep, nomecard, numerocard, mescard, anocard, cvvcard, valor) VALUES(:firstname, :email, :adr, :city, :state,:zip,:cname,:ccnum,:expmonth,:expyear,:cvv,:price)";
$stmt_ins = $pdo->prepare($sql_ins);

$sql_upd = "UPDATE compras SET email = :email, endereco = :adr, cidade = :city, estado = :state, cep = :zip, nomecard = :cname, numerocard = :ccnum, mescard = :expmonth, anocard = :expyear, cvvcard = :cvv, valor = :price WHERE nome = :firstname";
$stmt_upd = $pdo->prepare($sql_upd);

try {
    if ($stmt_search->execute(array(":firstname"=>$firstname))) {
        $dados = array(
			":firstname" => $firstname, 
			":email" => $email, 
			":adr" => $adr,
			":city" => $city,
			":state" => $state,
			":zip" => $zip,
			":cname" => $cname,
			":ccnum" => $ccnum,
			":expmonth" => $expmonth,
			":expyear" => $expyear,
			":cvv" => $cvv,
			":price" => $price
        );
        if ($stmt_search->rowCount() > 0) {
            $stmt_upd->execute($dados);
        } else {
            $stmt_ins->execute($dados);
        }
        header("Location: compra.html");
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
