<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$comments = $_POST['comments'];

$erro = false;

if ( !isset( $_POST ) || empty( $_POST ) ) {
	$erro = 'Nada foi postado.';
}

if ( ( ! isset( $name ) || ! is_string( $name ) ) && !$erro ) {
	$erro = 'A idade deve ser uma string.';
}

if ( ( ! isset( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) && !$erro ) {
	$erro = 'Envie um email válido.';
}

if ( ( ! isset( $comments ) || ! is_string( $comments ) ) && !$erro ) {
	$erro = 'O comentario deve ser valido.';
}

if ( $erro ) {
	echo $erro;
} else {

	echo "<h1> Veja os dados enviados</h1>";
	
	foreach ( $_POST as $chave => $valor ) {
		echo '<b>' . $chave . '</b>: ' . $valor . '<br><br>';
	}
}

echo "<p>Denuncia Recebida!</p>";
echo "<p>Nome: ${name}</p>";
echo "<p>email: ${email}</p>";
echo "<p>comments: ${comments}</p>";

?>