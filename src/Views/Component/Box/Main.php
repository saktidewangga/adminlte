<div class="box<?= $data->type ?? ' box-default' ?>">
    <?php if (!empty($data->head->title)): ?>
    <div class="box-header<?= $data->head->isWithBorder ? ' with-border': '' ?>">
        <h3 class="box-title"><?= $data->head->title ?></h3>
    </div>
    <?php endif; ?>
    <div class="box-body">
        <?= $data->body; ?>
    </div>
</div>