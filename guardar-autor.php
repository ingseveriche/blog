<?php

if(isset($_POST)){
	
	require_once 'includes/conexion.php';
	
	$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
	$descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
	$usuario = $_SESSION['usuario']['id'];
	
	// Validación
	$errores = array();
	
	if(empty($nombre)){
		$errores['nombre'] = 'El nombre no es válido';
	}
	
	if(empty($descripcion)){
		$errores['descripcion'] = 'La descripción no es válida';
	}
	
	if(count($errores) == 0){
		if(isset($_GET['editar'])){
			$autor_id = $_GET['editar'];
			
			$sql = "UPDATE autores SET nombre='$nombre', descripcion='$descripcion' ".
					" WHERE id = $autor_id";

		}else{
			$sql = "INSERT INTO autores VALUES(null, '$nombre', '$descripcion', CURDATE());";
		}
		$guardar = mysqli_query($db, $sql);

		header("Location: index.php");
	}else{

		$_SESSION["errores_autor"] = $errores;
		
		if(isset($_GET['editar'])){
			header("Location: editar-autor.php?id=".$_GET['editar']);
		}else{
			header("Location: crear-autores.php");
		}
	}
	
}

