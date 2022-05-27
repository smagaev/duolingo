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

                if (typeof(times) == 'undefined') {
                    times = "t_" + id_w + "=" + time;
                } else {
                    times = times+ "&t_" + id_w + "=" + time;
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
                    let _href = "javascript:location.href ='" + _link +"&" + times + "'";
                    $('.btn-next').removeClass('disabled')
                        .attr('onclick', _href);
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