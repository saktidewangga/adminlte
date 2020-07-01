<tr id="<?= $id; ?>">
<?php foreach ($columns as $column) : ?>
<?php if (is_string($column)) : ?>
    <td><?= $column ?></td>
<?php else : ?>
    <?= $column; ?>
<?php endif; ?>
<?php endforeach; ?>
</tr>