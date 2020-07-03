$('#<?= $id; ?> thead tr').clone(true).appendTo('#<?= $id; ?> thead');
$('#<?= $id; ?> thead tr:eq(0) th').each(function (i) {
    var title = $(this).text();

    if (title == '') {
    } else {
        $(this).html('<input style="width:100%" type="text" placeholder="Search ' + title + '"/>');

        $('input', this).on('keyup change', function () {
            if (<?= $id; ?>Var.column(i).search() !== this.value) {
                <?= $id; ?>Var.column(i).search(this.value).draw();
            }
        });
    }
});

<?php if ($isServerSide ?? false) : ?>
var <?= $id; ?>Var = $('#<?= $id; ?>').DataTable({
    sDom: '<"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-5"i><"col-sm-7"p>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
    sPaginationType: "full_numbers",
    orderMulti: true,
    searchDelay: 3000,
    processing: true,
    serverSide: true,
    ajax: window.location.href + "/data",
    columns: [
        <?php $i = 1; foreach ($columns as $field => $column) : ?>
        {
            data: "<?= is_array($column) ? $field : (is_numeric($field) ? $column : $field); ?>",
            name: "<?= is_array($column) ? (isset($column['label']) ? $column['label'] : ucwords(str_replace('_', ' ', $field))) : (is_numeric($field) ? ucwords(str_replace('_', ' ', $column)) : $column); ?>",
            searchable: true,
            orderable: true
        }<?= $i < count($columns) ? ',' : ''; ?>
        <?php $i++; endforeach; ?>
    ]
});
<?php else : ?>
var <?= $id; ?>Var = $('#<?= $id; ?>').DataTable({
    sDom: '<"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-5"i><"col-sm-7"p>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
    sPaginationType: "full_numbers",
});
<?php endif;?>