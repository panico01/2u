<?php


session_start();
require('conexao.php');


if(isset($_POST) && !empty($_FILES['image']['name']) && !empty($_POST['titulo'])){


	$name = $_FILES['image']['name'];
	list($txt, $ext) = explode(".", $name);
	$image_name = time().".".$ext;
	$tmp = $_FILES['image']['tmp_name'];


	if(move_uploaded_file($tmp, 'uploads/'.$image_name)){


		$sql = "INSERT INTO imagem_galeria (titulo, imagem) VALUES ('".$_POST['titulo']."', '".$image_name."')";
		$mysqli->query($sql);


		$_SESSION['success'] = 'Sucesso!';
		header("Location: http://localhost/2u");
	}else{
		$_SESSION['error'] = 'Falha ao enviar imagem';
		header("Location: http://localhost/2u");
	}
}else{
	$_SESSION['error'] = 'Título ou imagem em branco';
	header("Location: http://localhost/2u");
}


?>