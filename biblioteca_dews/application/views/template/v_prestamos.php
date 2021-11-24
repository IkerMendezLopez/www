<?php if (isset($prestados)) : ?>
	<h2>Prestados</h2>
	<ul>
		<?php foreach ($prestados as $value) : ?>
			<li><?php foreach ($libros as $libro) {
					if ($libro->idlibro == $value) echo $libro->titulo;
				} ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>

<?php if (isset($noprestados)) : ?>
	<h2>No prestados:</h2>
	<ul>
		<?php foreach ($noprestados as $value) : ?>
			<li><?php foreach ($libros as $libro) {
					if ($libro->idlibro == $value) echo $libro->titulo;
				} ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>