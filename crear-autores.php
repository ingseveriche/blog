<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>	
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
	<h1>Crear Autor</h1>
	<p>
		Ingresa toda la información relacionada a los autores.
	</p>
	<br/>
	<form action="guardar-autor.php" method="POST">
		<label for="nombre">Nombre:</label>
		<input type="text" name="nombre" />
		<?php echo isset($_SESSION['errores_autor']) ? mostrarError($_SESSION['errores_autor'], 'nombre') : ''; ?>
		
		<label for="descripcion">Descripción:</label>
		<textarea name="descripcion"></textarea>
		<?php echo isset($_SESSION['errores_autor']) ? mostrarError($_SESSION['errores_autor'], 'descripcion') : ''; ?>
		
		<input type="submit" value="Guardar" />
	</form>
	<?php borrarErrores(); ?>
</div> <!--fin principal-->
			
<?php require_once 'includes/pie.php'; ?>