<h1>Generos</h1>
<ul>
    <?php if(isset($generos)):?>
        <?php foreach($generos as $genero) :?>
            <li><a href='<?=site_url() ."/prestamos/$genero->genero"?>'><?php echo $genero->genero?></a></li>
        <?php endforeach;?>
    <?php endif;?>
</ul>
