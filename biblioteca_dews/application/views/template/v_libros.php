<?php echo form_open() ?>
<table>
    <thead>
        <tr>
            <th colspan="2">Titulo</th>
            <th>Autor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $libro) : ?>
            <tr>
                <td>
                    <!-- <input type="checkbox" name="" id=""> -->
                    <?php echo form_checkbox('idlibro[]', $libro->idlibro) ?>
                </td>
                <td><?php echo $libro->titulo ?></td>
                <td><?php echo $libro->autor ?></td>
            </tr>
        <?php endforeach; ?>


        <tr>
            <td colspan="3">
                <?php echo form_submit("prestar", "Prestar Libros") ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo form_close() ?>