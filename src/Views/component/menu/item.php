<li class="nav-item<?= !empty($item->childs) ? (' has-treeview' . ($item->isActive ? ' menu-open' : '')) : '' ?>">
    <a href="<?= !empty($item->childs) ? '#' : $item->link ?>" class="nav-link<?= $item->isActive ? ' active' : '' ?>">
        <i class="nav-icon <?= $item->icon ?>"></i>
        <p>
            <?= $item->name ?>
            <?= !empty($item->childs) ? '<i class="right fas fa-angle-left"></i>' : '' ?>
        </p>
    </a>

    <?php if (!empty($item->childs)) : ?>
        <ul class="nav nav-treeview">
            <?php foreach ($item->childs as $child) : ?>
                <?= view('AdminLTE\Views\menu\item', [
                    'item' => $child
                ]) ?>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</li>
