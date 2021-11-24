<div class="calendar"><?=$calendar?></div>
<?php if(isset($fecha)):?>
    <h1>A fecha de <?=$fecha?> fueron prestados los siguientes libros:</h1>
    <ul>
        <?php foreach($prestados as $value):?>
            <li><?=$value->titulo?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>
