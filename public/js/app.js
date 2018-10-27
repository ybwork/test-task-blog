function redirect(url) {
  var protocol = window.location.protocol + '//';
  var host = window.location.host;

  window.location.replace(protocol + host + url);
}

$(document).on('submit', '.auth', function(e) {
  e.preventDefault();

  var form = $(this);
  var action = form.attr('action');
  var method = form.attr('method');
  var data = new FormData(form[0]);

  $.ajax({
    url: action,
    type: method,
    data: data,
    processData: false,
    cache: false,
    contentType: false,

    success: function(data) {
      redirect('/');
    },

    error: function(e) {
      var error = $.parseJSON(e.responseText);
      form.find('.alert-danger').text(error.message).fadeIn();
    }
  });
});