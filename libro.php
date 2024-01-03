<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$libro_actual = conseguirLibro($db, $_GET['id']);

	if(!isset($libro_actual['id'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
		
<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1><?=$libro_actual['titulo']?></h1>
	
	<a href="autor.php?id=<?=$libro_actual['autor_id']?>">
		<h2><?=$libro_actual['autor']?></h2>
	</a>
	<h4>
		<?php if(!empty($libro_actual['serie'])): ?>
			<?=strtoupper($libro_actual['serie'])?> Libro #<?=$libro_actual['numero_libro']?>
		<?php endif; ?>
	</h4>
	<p>
		<?=$libro_actual['sinopsis']?>
	</p>
	<br/>
	<h4><?=$libro_actual['paginas']?> Páginas</h4>

	<div id="ver-todas">
		<a href="entradas.php">Ver todas las entradas</a>
	</div>
	
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>