<div class="box<?= $data->type ?? ' box-default' ?>">
    <?php if (!empty($data->head->title) || !empty($data->head->tool)): ?>
    <div class="box-header<?= $data->head->isWithBorder ? ' with-border': '' ?>">
        <?php if (!empty($data->head->title)) : ?>
        <h3 class="box-title"><?= $data->head->title ?></h3>
        <?php endif; ?>
        <?php if (!empty($data->head->tool)) : ?>
        <div class="box-tools">
        <?= $data->head->tool ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="box-body">
        <?= $data->body; ?>
    </div>
    <?php if (!empty($data->foot)) : ?>
    <div class="box-footer">
        <?= $data->foot; ?>
    </div>
    <?php endif; ?>
</div>