var <?= $id; ?>VarColumn = [
    <?php $i = 1; foreach ($columns as $field => $column) : ?>
    {
        data: "<?= is_array($column) ? $field : (is_numeric($field) ? $column : $field); ?>",
        name: "<?= is_array($column) ? (isset($column['label']) ? $column['label'] : ucwords(str_replace('_', ' ', $field))) : (is_numeric($field) ? ucwords(str_replace('_', ' ', $column)) : $column); ?>",
        searchable: <?= is_array($column) ? (isset($column['searchable']) ? ($column['searchable'] ? 'true' : 'false') : 'true') : 'true' ?>,
        orderable: <?= is_array($column) ? (isset($column['orderable']) ? ($column['orderable'] ? 'true' : 'false') : 'true') : 'true' ?>
    }<?= $i < count($columns) ? ',' : ''; ?>
    <?php $i++; endforeach; ?>
];

$('#<?= $id; ?> thead tr').clone(true).appendTo('#<?= $id; ?> thead');
$('#<?= $id; ?> thead tr:eq(1) th').each(function (i) {
    var title = $(this).text().trim();

    if (<?= $id; ?>VarColumn[i].searchable) {
        $(this).html('<input style="width:100%" type="text" placeholder="Search ' + title + '"/>');

        $('input', this).on('keyup change', function () {
            if (<?= $id; ?>Var.column(i).search() !== this.value) {
                <?= $id; ?>Var.column(i).search(this.value).draw();
            }
        });
    } else {
        $(this).text('');
    }
});

var <?= $id; ?>Var = $('#<?= $id; ?>').DataTable({
    sDom: '<"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-5"i><"col-sm-7"p>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
    sPaginationType: "full_numbers",
    orderMulti: true,
    processing: true,
    serverSide: true,
    <?php if ($isServerSide ?? false) : ?>
    ajax: window.location.href + "/data",
    <?php endif; ?>
    columns: <?= $id; ?>VarColumn,
    order: [
        <?php $i = 1; foreach ($columns as $field => $column) : ?>
        <?= is_array($column) ? (isset($column['orderable']) ? ($column['orderable'] ? (isset($column['order']) ? '[' . ($i - 1) . ', \'' . $column['order'] . '\'],' : '') : '') : (isset($column['order']) ? '[' . ($i - 1) . ', \'' . $column['order'] . '\'],' : '')) : '' ?>
        <?php $i++; endforeach; ?>
    ],
    orderCellsTop: true,
    fixedHeader: true
});
