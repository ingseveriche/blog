<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
	$autor_actual = conseguirAutor($db, $_GET['id']);

	if(!isset($autor_actual['id'])){
		header("Location: index.php");
	}
?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>
		
<!-- CAJA PRINCIPAL -->
<div id="principal">

	<h1>Libros de <?=$autor_actual['nombre']?></h1>
	
	<?php 
		$libros = conseguirLibrosAutor($db, $_GET['id']);

		if(!empty($libros) && mysqli_num_rows($libros) >= 1):
			while($libro = mysqli_fetch_assoc($libros)):
	?>
				<article class="entrada">
					<a href="libro.php?id=<?=$libro['id']?>">
						<h2><?=$libro['titulo']?></h2>
						<span class="fecha"><?=$libro['paginas']?> Páginas</span>
						<p>
							<?=substr($libro['sinopsis'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php
			endwhile;
		else:
	?>
		<p class="alerta">No hay libros del autor.</p>
	<?php endif; ?>
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>