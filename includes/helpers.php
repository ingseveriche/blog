<?php

function mostrarError($errores, $campo){
	$alerta = '';
	if(isset($errores[$campo]) && !empty($campo)){
		$alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>';
	}
	
	return $alerta;
}

function borrarErrores(){
	$borrado = false;
	
	if(isset($_SESSION['errores'])){
		$_SESSION['errores'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['error_login'])){
		$_SESSION['error_login'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_entrada'])){
		$_SESSION['errores_entrada'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_autor'])){
		$_SESSION['errores_autor'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['errores_libro'])){
		$_SESSION['errores_libro'] = null;
		$borrado = true;
	}
	
	if(isset($_SESSION['completado'])){
		$_SESSION['completado'] = null;
		$borrado = true;
	}
	
	return $borrado;
}

function conseguirCategorias($conexion){
	$sql = "SELECT * FROM categorias ORDER BY id ASC;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = $categorias;
	}
	
	return $resultado;
}

function conseguirAutores($conexion){
	$sql = "SELECT * FROM autores ORDER BY id ASC;";
	$autores = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($autores && mysqli_num_rows($autores) >= 1){
		$resultado = $autores;
	}
	
	return $resultado;
}

function conseguirLibros($conexion){
	$sql = "SELECT * FROM libros ORDER BY id ASC;";
	$libros = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($libros && mysqli_num_rows($libros) >= 1){
		$resultado = $libros;
	}
	
	return $resultado;
}

function conseguirCategoria($conexion, $id){
	$sql = "SELECT * FROM categorias WHERE id = $id;";
	$categorias = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($categorias && mysqli_num_rows($categorias) >= 1){
		$resultado = mysqli_fetch_assoc($categorias);
	}
	
	return $resultado;
}

function conseguirAutor($conexion, $id){
	$sql = "SELECT * FROM autores WHERE id = $id;";
	$autores = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($autores && mysqli_num_rows($autores) >= 1){
		$resultado = mysqli_fetch_assoc($autores);
	}
	
	return $resultado;
}

function conseguirLibro($conexion, $id){
	$sql = "SELECT l.*, a.nombre AS 'autor' FROM libros l ".
		   "INNER JOIN autores a ON l.autor_id = a.id ".
		   "WHERE l.id = $id";
	$libro = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($libro && mysqli_num_rows($libro) >= 1){
		$resultado = mysqli_fetch_assoc($libro);
	}
	
	return $resultado;
}

function conseguirEntrada($conexion, $id){
	$sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
		  . " FROM entradas e ".
		   "INNER JOIN categorias c ON e.categoria_id = c.id ".
		   "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		   "WHERE e.id = $id";
	$entrada = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entrada && mysqli_num_rows($entrada) >= 1){
		$resultado = mysqli_fetch_assoc($entrada);
	}
	
	return $resultado;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
	$sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
		 "INNER JOIN categorias c ON e.categoria_id = c.id ";
	
	if(!empty($categoria)){
		$sql .= "WHERE e.categoria_id = $categoria ";
	}
	
	if(!empty($busqueda)){
		$sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
	}
	
	$sql .= "ORDER BY e.id DESC ";
	
	if($limit){
		// $sql = $sql." LIMIT 4";
		$sql .= "LIMIT 4";
	}
	
	$entradas = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($entradas && mysqli_num_rows($entradas) >= 1){
		$resultado = $entradas;
	}
	
	return $entradas;
}

function conseguirLibrosAutor($conexion, $autor_id){
	$sql = "SELECT * FROM libros WHERE autor_id = $autor_id ORDER BY titulo ASC";
	
	$libros = mysqli_query($conexion, $sql);
	
	$resultado = array();
	if($libros && mysqli_num_rows($libros) >= 1){
		$resultado = $libros;
	}
	
	return $libros;
}