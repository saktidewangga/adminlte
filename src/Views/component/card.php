<div class="card">
    <?php if (!empty($card->title)) : ?>
        <div class="card-header">
            <h3 class="card-title"><?= $card->title ?></h3>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <?= $card->content ?? '' ?>
    </div>
</div>
