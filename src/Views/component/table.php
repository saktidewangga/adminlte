<table id="<?= $table->name ?>" class="table table-bordered table-striped">
    <thead>
        <tr>
            <?php foreach ($table->columns as $column) : ?>
                <th><?= $column ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($table->rows as $row) : ?>
            <tr>
                <?php foreach ($table->columns as $column) : ?>
                    <td><?= $row->{$column} ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <?php foreach ($table->columns as $column) : ?>
                <th><?= $column ?></th>
            <?php endforeach; ?>
        </tr>
    </tfoot>
</table>
