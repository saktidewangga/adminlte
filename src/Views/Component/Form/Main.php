<?= form_open($data->action, [
    'id' => $data->id,
    'class' => $data->class,
    'role' => 'form'
], $data->hidden) ?>



<?= form_close() ?>

<form method="<?= $data->method ?>" action="<?= $data->action ?>" id="<?= $data->id ?>" class="<?= $data->class ?>">
<?php foreach ($data->input as $name => $input) : ?>

<div class="form-group">

<?= isset($input['label']) ? \CI4Xpander_AdminLTE\View\Component\Label::create(\CI4Xpander_AdminLTE\View\Component\Label\Data::create([
    'for',
    'text' => $input['label']
])) : '' ?>

<?php if (in_array($input['type'], [
    'text'
])) : ?>

<?= \CI4Xpander_AdminLTE\View\Component\Input::create(\CI4Xpander_AdminLTE\View\Component\Input\Data::create([
    'name' => $name,
    'type' => $input['type']
])) ?>

<?php elseif (in_array($input['type'], [
    'textarea'
])) : ?>

<?= \CI4Xpander_AdminLTE\View\Component\TextArea::create(\CI4Xpander_AdminLTE\View\Component\TextArea\Data::create([
    'name' => $name,
])) ?>

<?php elseif ($input['type'] == 'buttonGroup') : ?>

<?php foreach ($input['buttons'] as $button) : ?>
<?= \CI4Xpander_AdminLTE\View\Component\Button::create(\CI4Xpander_AdminLTE\View\Component\Button\Data::create([
    'type' => $button['type'],
    'text' => $button['text']
])) ?>
<?php endforeach; ?>

<?php endif; ?>

</div>

<?php endforeach; ?>
</form>
