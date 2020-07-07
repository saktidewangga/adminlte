$('#<?= $id; ?>').select2({
    <?php if (isset($ajax)) : ?>
    ajax: {
        url: '<?= $ajax['url']; ?>',
        data: function (params) {
            return {
                search: params.term,
                page: params.page
            };
        },
        delay: 500,
        processResults: function(data) {
            console.log(data);
            return {
                results: data.data,
                pagination: {
                    more: data.pagination.more
                }
            };
        }
    },
    <?php if (isset($ajax['data']) && isset($options)) : ?>
    data: [
    <?php foreach ($options as $optionID => $option) : ?>
        <?php if (is_object($option)) : ?>
        {
            <?php foreach ($ajax['data'] as $dataField) : ?>
            <?= $dataField ?>: "<?= $option->{$dataField}; ?>",
            <?php endforeach; ?>
        },
        <?php elseif (is_array($option)) : ?>
        {
            <?php foreach ($ajax['data'] as $dataField) : ?>
            <?= $dataField ?>: "<?= $option[$dataField]; ?>",
            <?php endforeach; ?>
        },
        <?php else : ?>
        {
            id: "<?= $optionID; ?>",
            text: "<?= $option; ?>"
        }
        <?php endif; ?>
    <?php endforeach; ?>
    ],
    <?php endif; ?>
    <?php endif; ?>
    tags: <?= isset($isTags) ? ($isTags ? 'true' : 'false') : 'false' ?>,
    multiple: <?= isset($isMultiple) ? ($isMultiple ? 'true' : 'false') : 'false' ?>,
});
