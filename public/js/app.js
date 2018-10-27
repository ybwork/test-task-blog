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

      $('.auth p').removeClass(
          'error'
        ).addClass(
          'success'
        ).text(
          response.message
        ).show();

      setTimeout(function(){
          redirect();
      }, 500);
    },

    error: function(e) {
      var error = $.parseJSON(e.responseText);
      $('.error').text(error.message).show();
    }
  });
});

$(document).on('submit', '.common-ajax-form', function(e) {
  e.preventDefault();

  var form = $(this);

  form.find('.err-msg').remove();

  var action = form.attr('action');
  var method = form.attr('method');
  var data = new FormData(form[0]);
  var formId = form.attr('id');
  
  if(isValid(form)) {
    $.ajax({
      url: action,
      type: method,
      data: data,
      cache: false,
      processData: false,
      contentType: false,

      success: function(data) {
        var response = $.parseJSON(data);
        if(form.hasClass('form-delete')) {
          form.closest('tr').remove();
        }
        if(form.hasClass('form-add')) {
          updateTable();
        }
        if(formId == 'changePassword') {
          var error = form.find('.password-error').text();
          if (error != '') {
            form.find('.password-error').text('');
            form.find('.password-success').text(response.message);
          }
        }
      },

      error: function(e) {
        var error = $.parseJSON(e.responseText);
        if(formId == 'changePassword') {
          form.find('.password-error').text(error.message);
        }
      }
    });
  }
});

function isValid(form) {
  var clean = true;
  form.find('textarea, input[type="text"], input[type="number"], input[type="password"]').each(function() {
    if(!$(this).hasClass('no-validate')) {
      if($(this).val() == '') {
        $(this).addClass('err');
        $('<span class="err-msg">Поле не может быть пустым</span>').insertBefore($(this));
        clean = false;
      }
      if($(this).val().length > 255) {
        $(this).addClass('err');
        $('<span class="err-msg">Поле должно быть меньше 255 символов</span>').insertBefore($(this));
        clean = false;
      }
      if($(this).attr('type') == 'number' && $(this).val().length > 11) {
        $(this).addClass('err');
        $('<span class="err-msg">Поле должно быть меньше 11 символов</span>').insertBefore($(this));
        clean = false;
      }
    }
  });
  return clean;
}

$(document).on('focus', 'input, textarea', function() {
  $(this).removeClass('err');
  $(this).prevAll('.err-msg').remove();
});

function updateTable() {
  $.ajax({
    url: window.location.href,
    type: 'GET',
    success: function(data) {
      $(document).find('.table-dynamic').html($(data).find('.table-dynamic table'));
      setDateTimePicker();
    }
  });
}

$(document).on('click', '.form-edit', function() {
  $(this).toggleClass('hidden');
  $(this).siblings('button').toggleClass('hidden');
  $(this).closest('tr').find('td.editable').addClass('active');
});

$(document).on('click', '.form-save', function() {
  var editable = $(this).closest('tr').find('td.editable');
  var action = $(this).closest('tr').data('action');
  var id = $(this).closest('tr').data('id');
  var data = {};
  data['id'] = id;

  var allowToSend = true;

  editable.each(function() {
    if(isValid($(this).find('form'))) {
      var attrName = $(this).find('input, select, textarea').attr('name');
      if($(this).find('input').length) {
        if(attrName.indexOf('[]') !== -1) {
          var span = $(this).find('span');
          span.html('');
          $(this).find('input:checked').each(function() {
            span.append('<div>' + $(this).data('name') + '</div>')
          });
        } else {
          if(!$(this).find('input').hasClass('no-validate')) {
            $(this).find('span').text($(this).find('input').val());
          }
        }
      } else if($(this).find('textarea').length) {
        $(this).find('span').text($(this).find('textarea').val());
      } else {
        $(this).find('span').text($(this).find('option:selected').text());
      }
      if(attrName.indexOf('[]') !== -1) {
        data[attrName] = [];
        $(this).find('input:checked').each(function() {
          data[attrName].push($(this).val());
        });
      } else {
        data[attrName] = $(this).find('input, select, textarea').val();
      }
    } else {
      allowToSend = false;
    }
  });

  if(allowToSend) {
    editable.removeClass('active');
    $(this).toggleClass('hidden');
    $(this).siblings('button').toggleClass('hidden');
    submitData(action, data);
  }
});

function submitData(action, data) {
  $.ajax({
    url: action,
    type: 'POST',
    data: data,
    success: function(data) {
      console.log(data);
    }
  })
}















$('.change-password').on('click', function() {
  if($('.change-password-form').hasClass('change-password-form__active')) {
    $('.change-password-form')[0].reset();
    $('.change-password-form').removeClass('change-password-form__active');
    if ($('.change-password-form input').hasClass('error')) {
      $('.change-password-form input').removeClass('error');
    }
    if ($('.password-error').text() != '') {
      $('.password-error').hide();
      $('.password-error').text('');
    }
  } else {
    $('.change-password-form').addClass('change-password-form__active');
  }
});

$('body').on('mousedown', '.eye-icon', function(){
  $(this).siblings('input').attr('type', 'text');
  $(this).addClass('active');
});

$('body').on('mouseup', '.eye-icon', function(){
  $(this).siblings('input').attr('type', 'password');
  $(this).removeClass('active');
});

// Редактирование лота (заменить, когда появится js для редактирование)
$('.edit_lot').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/lot/update',
    type: 'POST',
    data: {
      id: 2,
      name: 'fix',
      description: 'error',
      price: 30000
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

// Удаление лота
$('.delete_lot').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/lot/delete',
    type: 'POST',
    data: {
      id: 2,
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

// Редактирование пользователя (заменить, когда появится js для редактирование)
$('.edit_user').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/user/update',
    type: 'POST',
    data: {
      id: 19,
      login: 'si',
      password: 'asdf'
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

// Удаление пользователя
$('.delete_user').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/user/delete',
    type: 'POST',
    data: {
      id: 19,
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

// Редактирование аукциона (заменить, когда появится js для редактирование)
$('.edit_auction').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/auction/update',
    type: 'POST',
    data: {
      id: 8,
      lot_id: 1,
      step_bet: 10000,
      start: '2017-11-23 11:38:42',
      stop: '2017-11-30 11:38:44',
      status: 1
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

// Удаление лота
$('.delete_auction').on('click', function(e){
  e.preventDefault();

  $.ajax({
    url: '/admin/auction/delete',
    type: 'POST',
    data: {
      id: 8,
    },

    success: function(data) {
      var response = $.parseJSON(data);
      console.log(response);
    },
    error: function(e) {
      var error = $.parseJSON(e.responseText);
      console.log(error);
    }
  });
});

function openMenu() {
 $('.user-name').on('click', function() {
   $('.header-nav__mobile').toggleClass('menu-active');
 });
}

var mobileMq = window.matchMedia('(max-width: 640px)');
var userAgent = window.navigator.userAgent;

function userBetCount() {
  $('.user-bet-item').each(function() {
    var currentUserBet = $(this).children('.table-align-right').children('.user-bet-value').text();
    var lastUserBet = $(this).next().find('.user-bet-value').text();
    var betCount = $(this).children('.table-align-right').children('.user-bet-count');
    var startPrice = $('#startPrice').text();
    var lastItem = $('.user-bet-item:last-child');
    var lastItemCount = currentUserBet - startPrice;
    var userBetCount = currentUserBet - lastUserBet;
    var totalCount;

    $(this).children('.table-align-right').children('.user-bet').text(accounting.formatNumber(currentUserBet, {
      thousand : " "
    }));

    if ($(this).is(':last-child')) {
      var totalCount = '+ ' + lastItemCount;
    } else {
      var totalCount = '+ ' + userBetCount;
    }

    betCount.text('+ ' + accounting.formatNumber(totalCount, {
      thousand: " "
    }));

    if (betCount.text() === '+ 0') {
      $('.user-bet-count:last').remove();
    }
  });
}

userBetCount();

if ($('.auction-card').length < 4) {
  $('.auction-card').parent().parent().addClass('center');
}

// Work with datatime
function setDateTimePicker() {
  $.datetimepicker.setLocale('ru');
  $(document).find('.datetimepicker').datetimepicker({
   i18n:{
    ru:{
     months:[
      'Январь','Февраль','Март','Апрель',
      'Май','Июнь','Июль','Август',
      'Сентябрь','Октябрь','Ноябрь','Декабрь'
     ],
     dayOfWeek:[
      'Понедельник','Вторник','Среда','Четверг',
      'Пятница','Суббота','Воскресенье'
     ],
    }
   },
   timepicker: true,
   format: 'Y-m-d H:i:s'
  });
}

setDateTimePicker();

// Время начала
var mounthStart = $('#mounthStartAuction').text();
var dayStart = $('#dayStartAuction').text();
var yearStart = $('#yearStartAuction').text();
var timeStart = $('#timeStartAuction').text();
var dateTimeStart = mounthStart + ' ' + dayStart + ' ' + yearStart + ' ' + timeStart;
var countUpDate = new Date(dateTimeStart).getTime();

// Время конца
var mounth = $('#mounthStopAuction').text();
var day = $('#dayStopAuction').text();
var year = $('#yearStopAuction').text();
var time = $('#timeStopAuction').text();
var dateTime = mounth + ' ' + day + ' ' + year + ' ' + time;
var countDownDate = new Date(dateTime).getTime();

if (document.getElementById('timeStartText') !== null) {
    document.getElementById('timeStartText').innerHTML = 'До старта аукциона';
}

var y = setInterval(function() {
    var nowStart = new Date();
    var distanceStart = countUpDate - nowStart.getTime();
    var daysStart = Math.floor(distanceStart / (1000 * 60 * 60 * 24));
    var hoursStart = Math.floor((distanceStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutesStart = Math.floor((distanceStart % (1000 * 60 * 60)) / (1000 * 60));
    var secondsStart = Math.floor((distanceStart % (1000 * 60)) / 1000);

    if (document.getElementById('timer') !== null) {
        document.getElementById('timer').innerHTML = daysStart + ' <span> д. </span> ' + hoursStart + ' <span> ч. </span> '
            + minutesStart + ' <span> м. </span> ' + secondsStart + ' <span> с. </span> ';
    }
    
    if (distanceStart < 0) {
        clearInterval(y);
        document.getElementById('timer').innerHTML = '';
        document.getElementById('timer').classList.remove('active');
        document.getElementById('startTimer').className = 'active';
        $('.auction-card__full-bet').removeClass('bet__hide');
        document.getElementById('timeStartText').innerHTML = 'До конца аукциона';
    }
}, 1000);

var x = setInterval(function() {
  var now = new Date();
  var distance = countDownDate - now.getTime();
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  if (document.getElementById('startTimer') !== null) {
    document.getElementById('startTimer').innerHTML = days + ' <span> д. </span> ' + hours + ' <span> ч. </span> '
          + minutes + ' <span> м. </span> ' + seconds + ' <span> с. </span> ';
  }

  if (distance < 0) {
      clearInterval(x);

      document.getElementById('startTimer').innerHTML = 'Аукцион закончен';

      var winUser = $('#history-bets .bet:first-child').data('user-login');
      var auctionStatus = $('.bet input[name="auction_status"]').val();
      var userId = $('#history-bets .bet:first-child').data('user-id');
      var auctionId = $('.bet input[name="auction_id"]').val();

      if (winUser && auctionStatus == 1) {
          $('.auction-card__full-bet').remove();
          $('.auction-card__full').append('<div id="winner">Аукцион выиграл ' + winUser + '</div>');
      } else if (!winUser && auctionStatus == 1) {
          $('.auction-card__full-bet').remove();
          $('.auction-card__full').append('<div id="winner">Победителей нет!</div>');
      } else if (winUser && auctionStatus == 3) {
          $('.auction-card__full-bet').remove();
          $('.auction-card__full').append('<div id="winner">Аукцион выиграл ' + winUser + '</div>');
      } else if (!winUser && auctionStatus == 3) {
          $('.auction-card__full-bet').remove();
          $('.auction-card__full').append('<div id="winner">Победителей нет!</div>');
      }

      $.ajax({
          url: '/auction/end',
          type: 'POST',
          data: {
              auction_id: auctionId,
          }, 

          success: function(data) {
              var response = $.parseJSON(data);
              console.log(response);
          },

          error: function(e) {
              var error = e.responseText();
          }
      });
  }
}, 1000);

$(document).ready(function() {
    if (mobileMq.matches || userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
      openMenu();
    }

    var betLast = parseInt($("#lastBet").text());

    $("#betLastSum").prepend(accounting.formatNumber(betLast, {
      thousand : " "
    }));

    $(".betCount").text(accounting.formatNumber(betLast, {
      thousand : " "
    }));

    var startPrice = parseInt($('#startPrice').text());

    $('#startPriceSum').prepend(accounting.formatNumber(startPrice, {
      thousand : " "
    }));

    $(".bet-sum").val(betLast);
    betStart = $(".bet-sum").val();

    $('.auction-card .card-price').each(function() {
      var startCardPrice = $(this).children('.start-lot-price').text();
      $(this).children('.card-lot-cost').text(accounting.formatNumber(startCardPrice, {
        thousand: " "
      }));
    })

    $('.auction-card .current-card-price').each(function() {
      var currentCardPrice = $(this).children('.current-card-price').text();
      $(this).children('.card-lot-cost').text(accounting.formatNumber(currentCardPrice, {
        thousand: " "
      }));
    })

    // Ставка
    $("body").on("click", ".auction-card__full-bet-value-change .add", function() {
        var betSum = $(this).parent().find('input');
        var betStep = betSum.attr("step");
        var betCount = parseInt(betSum.val()) + parseInt(betStep);
        var betPrev = betCount - parseInt(betStep);

        $('.betCount').text(accounting.formatNumber(betCount, {
          thousand : " "
        }));

        betSum.val(betCount);
        betSum.change();
        var formBet = betSum.val();

        $("form.common-ajax-form input[name='bet']").val(formBet);
        $("form.common-ajax-form input[name='previous_bet']").val(betPrev);
        $(".error-bet").text("");

        return false;
    });

    $("body").on("click", ".auction-card__full-bet-value-change .remove", function() {
        var betSum = $(this).parent().find('input');
        var betStart = parseInt($("#lastBet").text());
        var betStep = betSum.attr("step");

        var betCount = parseInt(betSum.val()) - parseInt(betStep);
        betCount = betCount > betStart ? betCount : betStart;
        var betPrev = betCount - parseInt(betStep);
        betSum.val(betCount);

        $('.betCount').text(accounting.formatNumber(betCount, {
          thousand : " "
        }));

        betSum.change();
        var formBet = betSum.val();
        $("form.common-ajax-form input[name='bet']").val(formBet);
        $("form.common-ajax-form input[name='previous_bet']").val(betPrev);
        $(".error-bet").text("");

        return false;
    });
});

(function() {
  $('.auction-card .auction-card-timer').each(function() {
    var $this = $(this);

    var auctionId = $(this).children('.auction_id').text();

    var nowStart = new Date(),
        mounthStart = $(this).children('.mounth-start-auction').text(),
        dayStart = $(this).children('.day-start-auction').text(),
        yearStart = $(this).children('.year-start-auction').text(),
        timeStart = $(this).children('.time-start-auction').text(),
        dateTimeStart = mounthStart + ' ' + dayStart + ' ' + yearStart + ' ' + timeStart,
        countUpDate = new Date(dateTimeStart).getTime();

    var distanceStart = countUpDate - nowStart.getTime();

    // Время конца
    var mounth = $(this).children('.mounth-stop-auction').text(),
        day = $(this).children('.day-stop-auction').text(),
        year = $(this).children('.year-stop-auction').text(),
        time = $(this).children('.time-stop-auction').text(),
        dateTime = mounth + ' ' + day + ' ' + year + ' ' + time,
        countDownDate = new Date(dateTime).getTime(),
        now = new Date(),
        distance = countDownDate - now.getTime();
    
        if (distanceStart < 0) {
            clearInterval(startTimer);

            $this.children('.auction-card-timer-start').text('');
            $this.children('.auction-card-timer-start').removeClass('active');
            $this.children('.auction-card-timer-stop').addClass('active');
            $this.children('.auction-card-timer-text').text('До конца аукциона');
        } else {

            if ($(this).children('.auction-card-timer-text') !== null) {
                $(this).children('.auction-card-timer-text').text('До старта аукциона');
            }

            var startTimer = setInterval(function() {
                var nowStart = new Date();

                var distanceStart = countUpDate - nowStart.getTime();
                if (distanceStart < 0) {
                    clearInterval(startTimer);

                    $this.children('.auction-card-timer-start').text('');
                    $this.children('.auction-card-timer-start').removeClass('active');
                    $this.children('.auction-card-timer-stop').addClass('active');
                    $this.children('.auction-card-timer-text').text('До конца аукциона');  
                } else {
                    var daysStart = Math.floor(distanceStart / (1000 * 60 * 60 * 24));
                    var hoursStart = Math.floor((distanceStart % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutesStart = Math.floor((distanceStart % (1000 * 60 * 60)) / (1000 * 60));
                    var secondsStart = Math.floor((distanceStart % (1000 * 60)) / 1000);

                    if ($this.children('.auction-card-timer-start') !== null) {
                        $this.children('.auction-card-timer-start').html('' + daysStart + ' <span> д. </span> ' + hoursStart + ' <span> ч. </span> '+
                        ''  + minutesStart + ' <span> м. </span> ' + secondsStart + ' <span> с. </span> ');
                    }
                }   
            }, 1000);
        }

        if (distance < 0) {
            clearInterval(stopTimer);
            console.log('home end');
            var thisTimer = $this.parent();

            thisTimer.addClass('active');
            thisTimer.children('.auction-card-winner').html('Аукцион завершен');

            $.ajax({
                url: '/auction/end',
                type: 'POST',
                data: {
                    auction_id: auctionId,
                }, 
    
                success: function(data) {
                    var response = $.parseJSON(data);
                    console.log(response);
                },
    
                error: function(e) {
                    var error = e.responseText();
                }
            });
        } else {
            var stopTimer = setInterval(function() {
                var now = new Date();
                var distance = countDownDate - now.getTime();
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
                if ($this.children('.auction-card-timer-stop') !== null) {
                    $this.children('.auction-card-timer-stop').html('' + days + ' <span> д. </span> ' + hours + ' <span> ч. </span> '+
                        '' + minutes + ' <span> м. </span> ' + seconds + ' <span> с. </span> ');
                }

                if (distance < 0) {
                    clearInterval(stopTimer);

                    var thisTimer = $this.parent();

                    thisTimer.addClass('active');
                    thisTimer.children('.auction-card-winner').html('Аукцион завершен');

                    $.ajax({
                        url: '/auction/end',
                        type: 'POST',
                        data: {
                            auction_id: auctionId
                        }, 
            
                        success: function(data) {
                            var response = $.parseJSON(data);
                        },
            
                        error: function(e) {
                            var error = e.responseText();
                        }
                    });
                }
            }, 1000);
        }
    });
})();