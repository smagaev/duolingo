<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="site-index">
        <br>
        <div class="body-content text-center">
            <? for ($i = 0; $i < 5; $i++) {
                $k = $i + 1;
                $id_rand = count($words);
                $arr_eng[$i] = '<div class="btn my_btn btn-defult border-dark col-sm-3" data-id="' . $k . '"><span class="display">' . $words[$i]->word . '</span></div>';
                $arr_tr[$i] = '<div class="btn my_btn btn-default border-dark col-sm-3" data-id="' . $k . '"><span>' . $words[$i]->var1 . '</span></div>';
            }
            shuffle($arr_tr);
            ?>
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-2">Progress: <span id="ready"><?= $count_ready ?></span> of <?= $count_words ?></div>
            </div>
            </br>

            <?
            for ($i = 0; $i < 5; $i++) {
                ?>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <?= $arr_eng[$i] ?>
                    <div class="col-sm-2"></div>
                    <?= $arr_tr[$i] ?>
                    <div class="col-sm-2"></div>
                </div>
                <br>

            <? } ?>

        </div>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="btn btn-next btn-primary col-sm-4" onclick="window.location.reload()">Next</div>
            <div class="col-sm-4"></div>
        </div>
    </div>
<? $this->registerJs("
   
    $('.my_btn').click(function () {
               
                  if(!$('.btn_sel').hasClass('bg-success')){
                                    $(this).addClass('btn_sel')
                                           .addClass('bg-success');
                                            id = $(this).data('id');
                        } else { 
                                    if( $(this).data('id') == id){
                                                    $(this).addClass('bg-success')
                                                           .addClass('btn_sel');
                                                    t1 = window.setTimeout(function(){
                                                           
                                                           $('.btn_sel').addClass('disabled')
                                                                        .removeClass('bg-success')
                                                                        .removeClass('btn_sel')
                                                                        .unbind();
                                                    
                                                    },500);
                                                
                                            }else{
                                                    
                                                    $('.btn_sel').removeClass('bg-success')
                                                                 .addClass('bg-danger');
                                                    $(this).addClass('bg-danger')
                                                           .addClass('btn_sel');
                                                    t2 = window.setTimeout(function(){
                                                    
                                                            $('.btn_sel').removeClass('bg-danger')
                                                                         .removeClass('btn_sel');
                                                    
                                                    
                                                    },500);
                                                    
                                            }
                  
                  }
          
                 
         
        
    });
    ", yii\web\View::POS_READY, 'my_btn_handler'); ?>