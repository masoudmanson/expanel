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
            $('.modal:visible').each(reposition);
            $('#modalSubmit').on('click', function() {
                $('#rateForm' + id)[0]['rate'].value = amount;
                $('#rateForm' + id)[0].submit();
            });
        }
    });

    $('.modal').on('show.bs.modal', reposition);

    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });

    $('.searchForm').keyup(function(event) {
        var keyword = $(this).val();
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad('/search/transactions?keyword=' + keyword);
        }
    });

    $('.searchHistoryForm').keyup(function(event) {
        var keyword = $(this).val();
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad('/search/histories?keyword=' + keyword);
        }
    });

    $('.searchExhouseForm').keyup(function(event) {
        var keyword = $(this).val();
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad('/search/users/exhouse?keyword=' + keyword);
        }
    });

    $('.searchFanapForm').keyup(function(event) {
        var keyword = $(this).val();
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad('/search/users/fanap?keyword=' + keyword);
        }
    });

    $('.searchOtherForm').keyup(function(event) {
        var keyword = $(this).val();
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad('/search/users/other?keyword=' + keyword);
        }
    });

    $('.specialAnchor').on('click', function() {
        var perName = $(this).find('.toggle').attr('data-perName');

        $('.specialAnchor').removeClass('active');
        $(this).addClass('active');

        var per = $(this).find('.toggle').attr('data-per');
        App.blockUI({
            target: '#perWrapperContainer',
            animate: !0,
        });

        $.ajax({
            method: 'get',
            url: '/home?per=' + per,
            data: {
                '_token': csrfToken,
                'X-CSRF-TOKEN': csrfToken,
            },
            success: function(data) {
                $('#perWrapper').html(data);
                $('.perName').text(perName);
                App.unblockUI('#perWrapperContainer');
            },
            error: function(){
                console.log('Error');
            }
        }).fail(function(data) {
            $('#perWrapper').html('<h2 class="text-danger text-center">متاسفانه مشکلی در درخواست رخ داد. لطفا دوباره تلاش نمائید!</h2>');
            App.unblockUI('#perWrapperContainer');
        });
    });

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }
            else {
                ajaxPageLoad(page);
            }
        }
    });

    toastr.options = {
        'closeButton': true,
        'debug': false,
        'positionClass': 'toast-top-right',
        'onclick': null,
        'showDuration': '1000',
        'hideDuration': '1000',
        'timeOut': '5000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut',
    };

    // todo: Async Messages
    // toastr.warning('My name is Inigo Montoya. You killed my father, prepare
    // to die!'); toastr.success('Have fun storming the castle!', 'Miracle Max
    // Says'); toastr.error('I do not think that word means what you think it
    // means.', 'Inconceivable!');

});

$(document).on('click', '.transConfirmLinks', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var url = $(this).attr('data-url');
    var transId = $(this).attr('data-id');
    var transUserID = $(this).attr('data-userId');
    var transUser = $(this).attr('data-user');
    var transUserMobile = $(this).attr('data-userMobile');

    $('#transConfirmModal').modal('show');
    $('#transConfirmModal').
        find('#transConfirmBody').
        html(
            '<h4 class="text-center">کاربر : <span class="font-green-meadow" id="transConfirmUser"></span></h4>' +
            '<p class="text-center">کد ملی : <span class="font-green-meadow" id="transConfirmUserID"></span></p>' +
            '<p class="text-center">شماره موبایل : <span class="font-green-meadow" id="transConfirmUserMobile"></span></p>');
    $('#transConfirmModal').find('#transConfirmSubmit').show();

    $('#transConfirmModal').find('#transConfirmUser').text(transUser);
    $('#transConfirmModal').find('#transConfirmUserID').text(transUserID);
    $('#transConfirmModal').
        find('#transConfirmUserMobile').
        text(transUserMobile);
    $('.modal:visible').each(reposition);
    $('#transConfirmSubmit').on('click', function() {
        $('#transConfirmModal').
            find('#transConfirmBody').
            html(
                '<h3 class="font-grey-silver text-center">لطفا شکیبا باشید ...</h3>');
        $('#transConfirmModal').find('#transConfirmSubmit').hide();
        $.ajax({
            method: 'PUT',
            url: url + transId,
            data: {
                'confirmed': true,
                '_token': csrfToken,
                'X-CSRF-TOKEN': csrfToken,
            },
        }).done(function(data) {
            var message = $.parseJSON(data);
            $('#transConfirmModal').
                find('#transConfirmBody').
                html('<h2 class="font-green-meadow text-center">' +
                    message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
            if (message.status) {
                $('#trans_' + transId).slideUp(200);
            }
        }).fail(function(data) {
            var message = $.parseJSON(data);
            $('#transConfirmModal').
                find('#transConfirmBody').
                html(
                    '<h2 class="font-red-mint text-center">' + message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
        });
    });
});

$(document).on('click', '.factorConfirmLinks', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var factorId = $(this).attr('data-id');
    var transURI = $(this).attr('data-uri');

    $('#factorConfirmModal').modal('show');
    $('#factorConfirmModal').
        find('#factorConfirmBody').
        html(
            '<h3 class="text-center">شماره فاکتور : <span class="font-red-flamingo" id="factorConfirmURI"></span></h3>');
    $('#factorConfirmModal').find('#factorConfirmSubmit').show();

    $('#factorConfirmModal').find('#factorConfirmURI').text(transURI);
    $('#factorConfirmSubmit').on('click', function() {
        $('#factorConfirmModal').
            find('#factorConfirmBody').
            html(
                '<h3 class="font-grey-silver text-center">لطفا شکیبا باشید ...</h3>');
        $('#factorConfirmModal').find('#factorConfirmSubmit').hide();
        $('.modal:visible').each(reposition);
        $.ajax({
            method: 'PUT',
            url: '/factors/' + factorId,
            data: {
                'confirmed': true,
                '_token': csrfToken,
                'X-CSRF-TOKEN': csrfToken,
            },
        }).done(function(data) {
            var message = $.parseJSON(data);
            $('#factorConfirmModal').
                find('#factorConfirmBody').
                html('<h2 class="font-green-meadow text-center">' +
                    message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
            if (message.status) {
                $('#factor_' + factorId).slideUp(200);
            }
        }).fail(function(data) {
            var message = $.parseJSON(data);
            $('#factorConfirmModal').
                find('#factorConfirmBody').
                html(
                    '<h2 class="font-red-mint text-center">' + message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
        });
    });
});

$(document).on('click', '.transRejectLinks', function(event) {
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
        $('.modal:visible').each(reposition);
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
                html('<h2 class="font-green-meadow text-center">' +
                    message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
            if (message.status) {
                $('#trans_' + transId).slideUp(200);
            }
        }).fail(function(data) {
            var message = $.parseJSON(data);
            $('#transRejectModal').
                find('#transRejectBody').
                html(
                    '<h2 class="font-red-mint text-center">' + message.msg +
                    '</h2>');
            $('.modal:visible').each(reposition);
        });
    });
});

$(document).on('click', '.rateTabsLink', function(event) {
    // var url = new URL(window.location.href);
    // console.log(window.location);
    // var page = url.searchParams.get('page');
    // if (page > 1) {
    //     window.location.href = window.location.origin + url.pathname +
    //         '?page=1' +
    //         $(this).attr('href');
    // }
});

$(document).on('click', '.transShowLinks', function(event) {
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
            $('.modal:visible').each(reposition);
        }
        else {
            $('#transShowModal').
                find('#transShowBody').
                html(
                    '<h2 class="font-red-mint text-center">دریافت تراکنش با مشکل مواجه شد!</h2>');
            $('.modal:visible').each(reposition);
        }
    }).fail(function() {
        $('#transShowModal').
            find('#transShowBody').
            html(
                '<h2 class="font-red-mint text-center">دریافت تراکنش با مشکل مواجه شد!</h2>');
        $('.modal:visible').each(reposition);
    });
});

$(document).on('click', '.fanapUsersLinks', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var transId = $(this).attr('data-id');
    $('#fanapUserModal').modal('show');

    $.ajax({
        method: 'get',
        url: '/fanap/' + transId,
        data: {
            '_token': csrfToken,
            'X-CSRF-TOKEN': csrfToken,
        },
    }).done(function(data) {
        if (data) {
            $('#fanapUserModal').find('#fanapUserBody').html(data);
            $('.modal:visible').each(reposition);
        }
        else {
            $('#fanapUserModal').
                find('#fanapUserBody').
                html(
                    '<h2 class="font-red-mint text-center">دریافت اطلاعات کاربر با مشکل مواجه شد!</h2>');
            $('.modal:visible').each(reposition);
        }
    }).fail(function() {
        $('#fanapUserModal').
            find('#fanapUserBody').
            html(
                '<h2 class="font-red-mint text-center">دریافت اطلاعات کاربر با مشکل مواجه شد!</h2>');
        $('.modal:visible').each(reposition);
    });
});

$(document).on('click', '.pagination a', function(e) {
    // e.preventDefault();
    // ajaxPageLoad($(this).attr('href'));
});

$(document).on('click', '.orderBy', function() {
    orderType = $(this).attr('data-order');
    var url = $(this).attr('data-url');
    if ($(this).attr('data-option') == 'ASC') {
        orderOption = 'DESC';
    }
    else {
        orderOption = 'ASC';
    }

    $.ajax({
        method: 'GET',
        url: url,
        data: {
            'order': orderType,
            'option': orderOption,
            '_token': csrfToken,
            'X-CSRF-TOKEN': csrfToken,
        },
        dataType: 'json',
    }).done(function(result) {
        $('#ajax-transaction-list').html(result);
    }).fail(function() {
        alert('مشکلی در درخواست ها رخ داد، لطفا دوباره تلاش نمایید.');
    });
});

function ajaxPageLoad(url) {
    orderType = $(this).attr('data-order');
    if ($(this).attr('data-option') == 'ASC') {
        orderOption = 'DESC';
    }
    else {
        orderOption = 'ASC';
    }

    $.ajax({
        method: 'get',
        url: url,
        data: {
            'order': orderType,
            'option': orderOption,
            '_token': csrfToken,
            'X-CSRF-TOKEN': csrfToken,
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
        },
    }).done(function(response) {
        $('#mainFormLoader').fadeOut(200);
        $('#ajax-transaction-list').html(response);
    }).fail(function() {
        console.log('Posts could not be loaded.');
    });
}

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

