<h1>Generos</h1>
<ul>
    <?php foreach($generos as $genero) :?>
        <li><a href='<?=site_url() ."/libros/$genero->genero"?>'><?=$genero->genero?></a></li>
    <?php endforeach;?>
</ul>
