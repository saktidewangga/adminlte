<?php
$liClass = [];
if (!empty($data->childs)) {
    $liClass[] = 'treeview';
    if ($data->isActive) {
        $liClass[] = 'menu-open';
    }
}

if ($data->isActive) {
    $liClass[] = 'active';
}
?>

<li class="<?= !empty($liClass) ? implode(' ', $liClass) : '' ?>">
    <a href="<?= base_url($data->url); ?>">
        <i class="<?= $data->icon ?>"></i> <?= !empty($data->childs) ? "<span>{$data->name}</span>" : $data->name ?>
        <?php if (!empty($data->childs)) : ?>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        <?php endif; ?>
    </a>

    <?php if(!empty($data->childs)) : ?>
    <ul class="treeview-menu">
    <?php foreach ($data->childs as $child): ?>
    <?= \CI4Xpander_AdminLTE\View\Component\Menu\Item::create($child)->render(); ?>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</li>