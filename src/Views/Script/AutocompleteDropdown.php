var propSelect2<?= $id; ?> = {
    <?php if (isset($ajax)) : ?>
    ajax: {
        url: '<?= $ajax['url']; ?>',
        data: function (params) {
            var query = {
                search: params.term,
                page: params.page
            };

            <?php if (isset($ajax['chained'])) : ?>
            <?php if (isset($ajax['chained']['query'])) : ?>
            <?php foreach ($ajax['chained']['query'] as $query => $source) : ?>
            query.<?= $query; ?> = $('#<?= $source ?>').val();
            <?php endforeach; ?>
            <?php endif; ?>
            <?php endif; ?>

            return query;
        },
        delay: 500,
        processResults: function(data) {
            if (data.pagination.current_page == 1) {
                data.data.unshift({
                    id: 0,
                    text: ""
                });
            }

            return {
                results: data.data,
                pagination: {
                    more: data.pagination.current_page < data.pagination.total_page
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
};

$('#<?= $id; ?>').select2(propSelect2<?= $id; ?>);

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    $('#<?= $id; ?>').select2(propSelect2<?= $id; ?>);
})
