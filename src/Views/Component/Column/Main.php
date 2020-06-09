<?php
$class = 'col-lg-12';
if (is_string($data->class)) {
    $class = $data->class;
}
?>

<div class="<?= $class ?>">
    <?= $data->content; ?>
</div>