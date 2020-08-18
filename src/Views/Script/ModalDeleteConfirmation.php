$('#modalDelete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var modal = $(this)
  modal.find('.modal-footer input[name=id]').val(id)
})