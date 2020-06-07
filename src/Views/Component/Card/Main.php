<div class="card">
    <?php if (!empty($data->title)) : ?>
        <div class="card-header">
            <h3 class="card-title"><?= $data->title ?></h3>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <?= $data->content ?? '' ?>
    </div>
</div>
