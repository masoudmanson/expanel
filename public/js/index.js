$(document).on('ready', function() {
  $('.rateFormRate').priceFormat({
    limit: 6,
    centsLimit: 0,
    prefix: 'ریال ',
  });

  $('.rateForm').on('submit', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var id = $(this).attr('data-id');
    var currency = ($('#rateForm' + id)[0]['currency_id'].value == 1)
        ? 'یورو'
        : 'لیره ترکیه';
    var amount = Number($(this).find('.rateFormRate').unmask());
    if (amount > 0) {
      $('#rateModal #currency_name').text(currency);
      $('#rateModal #rate_amount').text(number_format(amount) + 'ریال ');
      $('#rateModal').modal('show');
      $('#modalSubmit').on('click', function() {
        $('#rateForm' + id)[0]['rate'].value = amount;
        $('#rateForm' + id)[0].submit();
      });
    }
  });

  $('.transShowLinks').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var transId = $(this).attr('data-id');
    $('#transShowModal').modal('show');

    $.ajax({
      method: 'get',
      url: '/transactions/' + transId,
      data: {
        'accepted': true,
        '_token': csrfToken,
        'X-CSRF-TOKEN': csrfToken,
      },
    }).done(function(data) {
      if (data) {
        $('#transShowModal').find('#transShowBody').html(data);
      }
      else {
        $('#transShowModal').
            find('#transShowBody').
            html(
                '<h2 class="font-red-mint text-center">دریافت تراکنش با مشکل مواجه شد!</h2>');
      }
    }).fail(function() {
      $('#transShowModal').
          find('#transShowBody').
          html(
              '<h2 class="font-red-mint text-center">دریافت تراکنش با مشکل مواجه شد!</h2>');
    });
  });

  $('.transConfirmLinks').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var transId = $(this).attr('data-id');
    var transURI = $(this).attr('data-uri');
    var transUser = $(this).attr('data-user');

    $('#transConfirmModal').modal('show');
    $('#transConfirmModal').
        find('#transConfirmBody').
        html(
            '<h3 class="text-center">شماره تراکنش : <span class="font-red-flamingo" id="transConfirmURI"></span></h3>' +
            '<h4 class="text-center">توسط <span class="font-green-meadow" id="transConfirmUser"></span></h4>');
    $('#transConfirmModal').find('#transConfirmSubmit').show();

    $('#transConfirmModal').find('#transConfirmURI').text(transURI);
    $('#transConfirmModal').find('#transConfirmUser').text(transUser);
    $('#transConfirmSubmit').on('click', function() {
      $('#transConfirmModal').
          find('#transConfirmBody').
          html(
              '<h3 class="font-grey-silver text-center">لطفا شکیبا باشید ...</h3>');
      $('#transConfirmModal').find('#transConfirmSubmit').hide();
      $.ajax({
        method: 'PUT',
        url: '/transactions/' + transId,
        data: {
          'confirmed': true,
          '_token': csrfToken,
          'X-CSRF-TOKEN': csrfToken,
        },
      }).done(function(data) {
        var message = $.parseJSON(data);
        $('#transConfirmModal').
            find('#transConfirmBody').
            html('<h2 class="font-green-meadow text-center">' + message.msg +
                '</h2>');
        if (message.status) {
          $('#trans_' + transId).slideUp(200);
        }
      }).fail(function(data) {
        var message = $.parseJSON(data);
        $('#transConfirmModal').
            find('#transConfirmBody').
            html('<h2 class="font-red-mint text-center">' + message.msg +
                '</h2>');
      });
    });
  });

  $('.transRejectLinks').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var transId = $(this).attr('data-id');
    var transURI = $(this).attr('data-uri');
    var transUser = $(this).attr('data-user');

    $('#transRejectModal').modal('show');
    $('#transRejectModal').
        find('#transRejectBody').
        html(
            '<h3 class="text-center">شماره تراکنش : <span class="font-red-flamingo" id="transRejectURI"></span></h3><h4 class="text-center">توسط <span class="font-green-meadow" id="transRejectUser"></span></h4>');
    $('#transRejectModal').find('#transRejectSubmit').show();

    $('#transRejectModal').find('#transRejectURI').text(transURI);
    $('#transRejectModal').find('#transRejectUser').text(transUser);
    $('#transRejectSubmit').on('click', function() {
      $('#transRejectModal').
          find('#transRejectBody').
          html(
              '<h3 class="font-grey-silver text-center">لطفا شکیبا باشید ...</h3>');
      $('#transRejectModal').find('#transRejectSubmit').hide();
      $.ajax({
        method: 'PUT',
        url: '/transactions/' + transId,
        data: {
          'rejected': true,
          '_token': csrfToken,
          'X-CSRF-TOKEN': csrfToken,
        },
      }).done(function(data) {
        var message = $.parseJSON(data);
        $('#transRejectModal').
            find('#transRejectBody').
            html('<h2 class="font-green-meadow text-center">' + message.msg +
                '</h2>');
        if (message.status) {
          $('#trans_' + transId).slideUp(200);
        }
      }).fail(function(data) {
        var message = $.parseJSON(data);
        $('#transRejectModal').
            find('#transRejectBody').
            html('<h2 class="font-red-mint text-center">' + message.msg +
                '</h2>');
      });
    });
  });

  $('.rateTabsLink').on('click', function() {
    var url = new URL(window.location.href);
    var page = url.searchParams.get('page');
    if (page > 1) {
      window.location.href = window.location.origin + url.pathname + '?page=1' +
          $(this).attr('href');
    }
  });

  $('.modal').on('show.bs.modal', reposition);
  $(window).on('resize', function() {
    $('.modal:visible').each(reposition);
  });
});

function reposition() {
  var modal = $(this),
      dialog = modal.find('.modal-dialog');
  modal.css('display', 'block');

  dialog.css('margin-top',
      Math.max(0, ($(window).height() - dialog.height()) / 2));
}

var localtime = +Date.now();
var diff = serverTime - localtime;

function startTime() {
  var today = new Date(+Date.now() + diff);
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  $('.server-time').text(h + ':' + m + ':' + s);
  var t = setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {
    i = '0' + i;
  }
  return i;
}

function number_format(number, decimals, dec_point, thousands_sep) {
  var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return Math.round(n * k) / k;
      },
      s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

