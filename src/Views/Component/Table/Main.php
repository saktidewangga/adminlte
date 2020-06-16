<table class="table table-bordered table-striped table-hover">
<?php if (count($data->columns) > 0) : ?>
    <tr>
    <?php foreach ($data->columns as $name => $title) : ?>
        <th><?= $title; ?></th>
    <?php endforeach; ?>
    </tr>
<?php endif; ?>

<?php foreach ($data->rows as $row) : ?>
    <tr>
    <?php foreach ($data->columns as $name => $title) : ?>
        <?php if (property_exists($row, $name)) : ?>
        <?php if (in_array($name, $data->rowAction)) : ?>
        <td><?= \Config\Services::parser()->setData([
            'id' => $row->id
        ])->renderString($row->{$name}); ?></td>
        <?php else : ?>
        <td><?= $row->{$name}; ?></td>
        <?php endif; ?>
        <?php else : ?>
        <td></td>
        <?php endif; ?>
    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
</table>