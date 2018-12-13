<?php

	require('database_functions.php');
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

?>

