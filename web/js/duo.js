$('.my_btn').click(function () {
    button = $(this);
    but_select = $('.btn_sel');
    if (!but_select.hasClass('bg-success')) {
        button.addClass('btn_sel')
              .addClass('bg-success');
        id = button.data('id');
        n = button.attr('id')
    }
    else {
        if (button.data('id') == id) {
            if(button.attr('id')!== n ) {
                button.addClass('bg-success')
                    .addClass('btn_sel');
                t1 = window.setTimeout(function () {

                    $('.btn_sel').addClass('disabled')
                        .removeClass('bg-success')
                        .removeClass('btn_sel')
                        .removeClass('btn_act')
                        .unbind();

                }, 500);
               if(document.querySelectorAll('.btn_act').length === 2){
                  $('.btn-next').removeClass('disabled')
                      .bind('click',function () {
                          location = "/";
                      })
               }
            } else {
                button.removeClass('bg-success')
                      .removeClass('btn_sel');
            }
        }
        else {

            $('.btn_sel').removeClass('bg-success')
                .addClass('bg-danger');
            button.addClass('bg-danger')
                .addClass('btn_sel');
            t2 = window.setTimeout(function () {

                $('.btn_sel').removeClass('bg-danger')
                    .removeClass('btn_sel');


            }, 500);

        }


    }


});