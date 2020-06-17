<table class="table table-bordered table-striped table-hover<?= $data->isDataTable ? ' ci4xpander-adminlte-datatable' : '' ?>">
<?php if (count($data->columns) > 0) : ?>
<thead>
    <tr>
    <?php foreach ($data->columns as $name => $title) : ?>
        <th><?= $title; ?></th>
    <?php endforeach; ?>
    </tr>
</thead>
<?php endif; ?>
<tbody>
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
</tbody>
<?php if (count($data->columns) > 0) : ?>
<tfoot>
    <tr>
    <?php foreach ($data->columns as $name => $title) : ?>
        <th><?= $title; ?></th>
    <?php endforeach; ?>
    </tr>
</tfoot>
<?php endif; ?>
</table>
