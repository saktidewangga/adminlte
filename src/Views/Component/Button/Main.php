<?php
$class[] = 'btn';

if (!empty($data->type)) {
    $class[] = 'btn-' . $data->type;
}

if (!empty($data->size)) {
    $class[] = 'btn-' . $data->size;
}

if ($data->isBlock) {
    $class[] = 'btn-block';
}

if ($data->isFlat) {
    $class[] = 'btn-flat';
}

if (!$data->isEnabled) {
    $class[] = 'disabled';
}
?>

<button type="button" class="<?= implode(' ', $class); ?>">
    <?= $data->text; ?>
</button>