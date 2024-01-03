<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Crear Libros</h1>
	<p>
		Agrega libros para las entradas, y el usuario pueda conocer sus caracteristicas y autor.
	</p>
	<br/>
	<form action="guardar-libro.php" method="POST">
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo" />
		<?php echo isset($_SESSION['errores_libro']) ? mostrarError($_SESSION['errores_libro'], 'titulo') : ''; ?>
		
		<label for="sinopsis">Sinopsis:</label>
		<textarea name="sinopsis"></textarea>
		<?php echo isset($_SESSION['errores_libro']) ? mostrarError($_SESSION['errores_libro'], 'sinopsis') : ''; ?>

		<br>
		<label for="paginas">Páginas:</label>
		<input type="number" name="paginas" />
		<?php echo isset($_SESSION['errores_libro']) ? mostrarError($_SESSION['errores_libro'], 'paginas') : ''; ?>

		<label for="serie">Serie:</label>
		<input type="text" name="serie" />

		<label for="nrolibro">Nro del Libro (Serie):</label>
		<input type="number" name="nrolibro" />

		<label for="autor">Autor</label>
		<select name="autor">
			<?php 
				$autores = conseguirAutores($db); 
				if(!empty($autores)):
				while($autor = mysqli_fetch_assoc($autores)): 
			?>
				<option value="<?=$autor['id']?>">
					<?=$autor['nombre']?>
				</option>
			<?php
				endwhile;
				endif;
			?>
		</select>
		<?php echo isset($_SESSION['errores_libro']) ? mostrarError($_SESSION['errores_libro'], 'autor') : ''; ?>
		
		<p><input type="submit" value="Guardar" /></p>
	</form>
	<?php borrarErrores(); ?>
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>