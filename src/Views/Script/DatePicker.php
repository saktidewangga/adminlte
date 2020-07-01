$('#<?= $id; ?>').daterangepicker({
    locale: {
        format: 'YYYY-MM-DD'
    },
    showDropdowns: true,
    singleDatePicker: true,
    autoUpdateInput: false
});

$('#<?= $id; ?>').on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD'));
});
