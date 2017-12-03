var url = '';

function redirect(url) {
  var protocol = window.location.protocol + '//';
  var host = window.location.host;
  var defaultUrl = '/';

  if (url) {
    window.location.replace(protocol + host + url);
  } else {
    window.location.replace(protocol + host + defaultUrl);
  }
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
      var response = $.parseJSON(data);

      $('.auth p').removeClass('error').addClass('success').text(response.message).show();

      setTimeout(function(){
          redirect();
      },1000);
    },

    error: function(e) {
      var error = $.parseJSON(e.responseText);
      $('.error').text(error.message).show();
    }
  });
});