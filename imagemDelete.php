<?php


session_start();
require_once('conexao.php');


if(isset($_POST) && !empty($_POST['id'])){


		$sql = "DELETE FROM imagem_galeria WHERE id = ".$_POST['id'];
		$mysqli->query($sql);


		$_SESSION['success'] = 'Imagem deletada!';
		header("Location: http://localhost/2u");
}else{
	$_SESSION['error'] = 'Erro';
	header("Location: http://localhost/2u");
}


?>