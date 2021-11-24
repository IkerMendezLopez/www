<?php if ($libros) : ?>
    <?= form_open('') ?>
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
                        <?= form_checkbox('idlibro[]', $libro->idlibro) ?>
                    </td>
                    <td><?= $libro->titulo ?></td>
                    <td><?= $libro->autor ?></td>
                </tr>
            <?php endforeach; ?>


            <tr>
                <td colspan="3">
                    <?= form_submit("prestar", "Prestar Libros") ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?= form_close() ?>
<?php else : ?>
    <h1>No hay libros del genero que buscas...</h1>
<?php endif; ?>