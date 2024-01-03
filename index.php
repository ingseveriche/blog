<?php require_once 'includes/cabecera.php'; ?>
		
<?php require_once 'includes/lateral.php'; ?>
		
<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Ultimas entradas</h1>
	
	<?php 
		$entradas = conseguirEntradas($db, true);
		if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
			while($entrada = mysqli_fetch_assoc($entradas)):
	?>
				<article class="entrada">
					<a href="entrada.php?id=<?=$entrada['id']?>">
						<h2><?=$entrada['titulo']?></h2>
						<span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
						<p>
							<?=substr($entrada['descripcion'], 0, 180)."..."?>
						</p>
					</a>
				</article>
	<?php endwhile; ?>
			<div id="ver-todas">
				<a href="entradas.php">Ver todas las entradas</a>
			</div>
	<?php
		else:
	?>
		<div class="alerta">¡No hay entradas disponibles!</div>
	<?php endif; ?>

</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>