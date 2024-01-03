<?php

if(isset($_POST)){
	
	require_once 'includes/conexion.php';
	
	$titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
	$sinopsis = isset($_POST['sinopsis']) ? mysqli_real_escape_string($db, $_POST['sinopsis']) : false;
	$paginas = isset($_POST['paginas']) ? mysqli_real_escape_string($db, $_POST['paginas']) : false;
	$serie = isset($_POST['serie']) ? mysqli_real_escape_string($db, $_POST['serie']) : false;
	$nrolibro = isset($_POST['nrolibro']) ? mysqli_real_escape_string($db, $_POST['nrolibro']) : false;
	$autor = isset($_POST['autor']) ? (int)$_POST['autor'] : false;
	$usuario = $_SESSION['usuario']['id'];
	
	// Validación
	$errores = array();
	
	if(empty($titulo)){
		$errores['titulo'] = 'El titulo no es válido';
	}
	
	if(empty($sinopsis)){
		$errores['sinopsis'] = 'La sinopsis no es válida';
	}

	if(empty($paginas)){
		$errores['paginas'] = 'Página no válida';
	}

	if(empty($nrolibro)){
		$nrolibro = 0;
	}
	
	if(empty($autor) && !is_numeric($autor)){
		$errores['autor'] = 'El autor no es válido';
	}
	
	
	if(count($errores) == 0){
		if(isset($_GET['editar'])){
			$libro_id = $_GET['editar'];
			$usuario_id = $_SESSION['usuario']['id'];
			
			$sql = "UPDATE libros SET autor_id=$autor, titulo='$titulo', sinopsis='$sinopsis', 
					paginas=$paginas, serie='$serie', numero_libro=$nrolibro ".
					" WHERE id = $libro_id";

		}else{
			$sql = "INSERT INTO libros VALUES(null, $autor, '$titulo', '$sinopsis', $paginas, '$serie', $nrolibro, CURDATE());";
		}
		$guardar = mysqli_query($db, $sql);

		header("Location: index.php");
	}else{

		$_SESSION["errores_libro"] = $errores;
		
		if(isset($_GET['editar'])){
			header("Location: editar-libro.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-libros.php");
		}
	}
	
}

