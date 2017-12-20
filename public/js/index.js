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
            $('.modal:visible').each(modalReposition);
            $('#modalSubmit').on('click', function() {
                App.blockUI({
                    target: '#rateModal .modal-dialog .modal-content',
                    animate: !0,
                });
                $('#rateForm' + id)[0]['rate'].value = amount;
                $('#rateForm' + id)[0].submit();
            });
        }
    });

    $('.noSpecialChars').bind('keyup paste', function(){
        this.value = this.value.replace(/[`۱۲۳۴۵۶۷۸۹۰~!@#$%^&*()_|+\-=؟?;:'",،؛.<>\{\}\[\]\\\/]/gi, '')
    });

    $('.noDigits').bind('keyup paste', function(){
        this.value = this.value.replace(/[0-9]/g, '');
    });

    $('.onlyDigits').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('.modal').on('show.bs.modal', modalReposition);

    $(window).on('resize', function() {
        $('.modal:visible').each(modalReposition);
    });

    $('.searchForm').keyup(function(event) {
        var keyword = $(this).val();
        var url = $(this).attr('data-url');
        var target = $(this).attr('data-target');
        if (event.which == 13 || event.keyCode == 13) {
            ajaxPageLoad(url + '?keyword=' + keyword, target);
        }
    });

    $('.searchBtn').click(function(event) {
        var keyword = $(this).parent().parent().find('.searchForm').val();
        var url = $(this).parent().parent().find('.searchForm').attr('data-url');
        var target = $(this).parent().parent().find('.searchForm').attr('data-target');
        ajaxPageLoad(url + '?keyword=' + keyword, target);
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
            error: function(xhr, ajaxOptions, thrownError){
                toastr.error('متاسفانه خطائی در درخواست رخ داد. لطفا دوباره تلاش نمائید.', 'خطا!');
                console.log(thrownError);
                document.getElementById('logout-form').submit();
            }
        }).fail(function(data) {
            toastr.error('متاسفانه خطائی در درخواست رخ داد. لطفا دوباره تلاش نمائید.', 'خطا!');
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
        'positionClass': 'toast-bottom-right',
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

    $('.print-transaction').on('click', function(e) {
        e.preventDefault();
        if (!window.print) {
            toastr.warning('مرورگر شما قابلیت چاپ به صورت PDF ندارد. لطفا با یک مرورگر دیگر تست نمائید.');
            return;
        }

        $('.page-container').hide();
        $('.modal-header').hide();
        $('.modal-footer').hide();

        window.print();

        $('.page-container').show();
        $('.modal-header').show();
        $('.modal-footer').show();
    });
});

$(document).on('click', '.ajaxModalLinks', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var modal = $(this).attr('data-modal');
    var url = $(this).attr('data-url');
    var id = $(this).attr('data-id');

    ajaxModal(modal, url, id);
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
    $('.modal:visible').each(modalReposition);
    $('#transConfirmSubmit').on('click', function() {
        $('#transConfirmModal').
            find('#transConfirmBody').
            html('<h3 class="font-grey-silver text-center">لطفا شکیبا باشید ...</h3>');
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
            $('.modal:visible').each(modalReposition);
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
            $('.modal:visible').each(modalReposition);
        });
    });
});

$(document).on('click', '.pagination a', function(e) {
    // uncomment to load data by ajax
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
        toastr.error('مشکلی در درخواست ها رخ داد، لطفا دوباره تلاش نمایید.', 'خطا!');
    });
});

function ajaxModal(modal, url, id){
    App.blockUI({
        target: '#' + modal + ' .modal-dialog',
        animate: !0,
    });
    $('#' + modal).modal('show');

    $.ajax({
        method: 'get',
        url: url + id,
        data: {
            '_token': csrfToken,
            'X-CSRF-TOKEN': csrfToken,
        }
    }).done(function(data) {
        if (data) {
            $('#' + modal).find('.modalData').html(data);
            $('.modal:visible').each(modalReposition);
        }
        else {
            toastr.error('دریافت اطلاعات با مشکل مواجه شد!', 'خطا!');
            $('#' + modal).find('.modalData').html('<h2 class="font-red-mint text-center">دریافت اطلاعات با مشکل مواجه شد!</h2>');
            $('.modal:visible').each(modalReposition);
        }
        App.unblockUI('#' + modal + ' .modal-dialog');
    }).fail(function() {
        toastr.error('دریافت اطلاعات با مشکل مواجه شد!', 'خطا!');
        $('#' + modal).find('.modalData').html('<h2 class="font-red-mint text-center">دریافت اطلاعات با مشکل مواجه شد!</h2>');
        $('.modal:visible').each(modalReposition);
        App.unblockUI('#' + modal + ' .modal-dialog');
    });
}

function ajaxPageLoad(url, target) {
    App.blockUI({
        target: target,
        animate: !0,
    });

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
            toastr.error(thrownError, 'خطا!');
        },
    }).done(function(response) {
        $('#mainFormLoader').fadeOut(200);
        $('#ajax-transaction-list').html(response);
        App.unblockUI(target);
    }).fail(function() {
        toastr.error('دریافت اطلاعات با مشکل مواجه شد!', 'خطا!');
        App.unblockUI(target);
    });
}

function modalReposition() {
    var modal = $(this),
        dialog = modal.find('.modal-dialog');
    modal.css('display', 'block');
    dialog.css('margin-top',
        Math.max(0, ($(window).height() - dialog.height()) / 2));
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

