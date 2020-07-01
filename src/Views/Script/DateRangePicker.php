$('#<?= $id; ?>').daterangepicker({
    locale: {
        format: '<?= $format; ?>',
        separator: '<?= $separator; ?>'
    },
    autoUpdateInput: false,
    showDropdowns: true
});

$('#<?= $id; ?>').on('apply.daterangapicker', function (ev, picker) {
    $(this).val(picker.startDate.format('<?= $format; ?>') + '<?= $separator; ?>' + picker.endDate.format('<?= $format; ?>'));
});