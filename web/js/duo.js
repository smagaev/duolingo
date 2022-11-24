$('.my_btn').click(function () {
    button = $(this);
    but_select = $('.btn_sel');
    if (!but_select.hasClass('bg-success')) {
        button.addClass('btn_sel')
            .addClass('bg-success');
        id = button.data('id');
        id_w = button.data('i');
        n = button.attr('id')
        startTime = new Date().getTime();
    } else {
        if (button.data('id') == id) {
            if (button.attr('id') !== n) {
                button.addClass('bg-success')
                    .addClass('btn_sel');
                time = new Date().getTime() - startTime;

                if (typeof (times) == 'undefined') {
                    times = "t_" + id_w + "=" + time;
                } else {
                    times = times + "&t_" + id_w + "=" + time;
                }
                t1 = window.setTimeout(function () {

                    $('.btn_sel').addClass('disabled')
                        .removeClass('bg-success')
                        .removeClass('btn_sel')
                        .removeClass('btn_act')
                        .unbind();

                }, 300);
                if (document.querySelectorAll('.btn_act').length === 2) {
                    let _link = "/index?quantity=" + $('.btn-next').data('quantity');
                    let _href = "javascript:location.href ='" + _link + "&" + times + "'";
                    let button_next = $('.btn-next');
                    if (button_next.hasClass('d-none')) {
                        window.location = _href;
                    } else {
                        button_next.removeClass('disabled')
                            .attr('onclick', _href);
                    }
                }
            } else {
                button.removeClass('bg-success')
                    .removeClass('btn_sel');
            }
        } else {

            $('.btn_sel').removeClass('bg-success')
                .addClass('bg-danger');
            button.addClass('bg-danger')
                .addClass('btn_sel');
            t2 = window.setTimeout(function () {

                $('.btn_sel').removeClass('bg-danger')
                    .removeClass('btn_sel');


            }, 300);

        }


    }


});
/*** part2 ***/
$('.input_z').click(function () {
    $(this).val('');
})

function compare_answer(a, b) {
    a = a.trim();
    b = b.trim();
    if (a !== b) {
        return "text-danger";
    } else return "text-light";
}

function checkAnswer(checkObj) {
    let _Obj = $(checkObj);
    let right_answer = _Obj.text();
    let your_answer = _Obj.siblings('.wrap-answer').children('.input_z').val();
    return compare_answer(right_answer, your_answer);

}


$('.btn_check').click(function () {
    let objs = $('.answer');
    $.each(objs, function (index, elem) {
        $(elem).removeClass('text-light').addClass(checkAnswer(elem));
    });
    $('.btn_check').css('display', 'none');
    $('.btn_next2').css('display', 'block');

});

$('.btn_next2').click(function () {
    let sendListOk = '';
    let sendListWrong = '';
    let sendList = '';
    $.each($('.text-danger'), function (index, elem) {
        sendListWrong = sendListWrong + "&t_" + $(elem).attr('id') + "=99999";
    });
    $.each($('.text-light'), function (index, elem) {
        sendListOk = sendListOk + "&t_" + $(elem).attr('id') + "=0";
    });
    sendList = sendListOk + sendListWrong;
    let url = new URL(window.location.href);
    let language = url.searchParams.get('language');
    language? language='&language=' + language : '';
    let _href = "/index?quantity=undefined" + sendList + language;
    window.location.href = _href;
})





