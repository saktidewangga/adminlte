<?php
$class[] = 'btn';

if (!empty($data->style)) {
    $class[] = 'btn-' . $data->style;
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

$attributes = [];
if (!empty($data->attributes)) {
    foreach ($data->attributes as $name => $value) {
        $attributes[] = "{$name}=\"{$value}\"";
    }
}
?>

<button type="<?= $data->type ?>" class="<?= implode(' ', $class); ?>" <?= implode(' ', $attributes) ?>>
    <?= $data->text; ?>
</button>
