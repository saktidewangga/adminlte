<div class="box<?= $data->type ?? ' box-default' ?>">
    <?php if (!empty($data->header->title)): ?>
    <div class="box-header<?= $data->header->isWithBorder ? ' with-border': '' ?>">
        <h3 class="box-title"><?= $data->header->title ?></h3>
    </div>
    <?php endif; ?>
    <div class="box-body">
        <?= $data->body; ?>
    </div>
</div>