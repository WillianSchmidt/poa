<?php 
// Cria uma variável que terá os dados do erro
$erro = false;

// Verifica se o POST tem algum valor
if ( !isset( $_POST ) || empty( $_POST ) ) {
	$erro = 'Nada foi postado.';
}

// Cria as variáveis dinamicamente
foreach ( $_POST as $chave => $valor ) {
	// Remove todas as tags HTML
	// Remove os espaços em branco do valor
	$$chave = trim( strip_tags( $valor ) );
	
	// Verifica se tem algum valor nulo
	if ( empty ( $valor ) ) {
		$erro = 'Existem campos em branco.';
	}
}

// Verifica se $idade realmente existe e se é um número. 
// Também verifica se não existe nenhum erro anterior
if ( ( ! isset( $idade ) || ! is_numeric( $idade ) ) && !$erro ) {
	$erro = 'A idade deve ser um valor número.';
}

// Verifica se $site realmente existe e se é uma URL. 
// Também verifica se não existe nenhum erro anterior
if ( ( ! isset( $site ) || ! filter_var( $site, FILTER_VALIDATE_URL ) ) && !$erro ) {
	$erro = 'Envie um site válido.';
}

// Verifica se $email realmente existe e se é um email. 
// Também verifica se não existe nenhum erro anterior
if ( ( ! isset( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) && !$erro ) {
	$erro = 'Envie um email válido.';
}

// Se existir algum erro, mostra o erro
if ( $erro ) {
	echo $erro;
} else {
	// Se a variável erro continuar com valor falso
	// Você pode fazer o que preferir aqui, por exemplo, 
	// enviar para a base de dados, ou enviar um email
	// Tanto faz. Vou apenas exibir os dados na tela.
	echo "<h1> Veja os dados enviados</h1>";
	
	foreach ( $_POST as $chave => $valor ) {
		echo '<b>' . $chave . '</b>: ' . $valor . '<br><br>';
	}
}