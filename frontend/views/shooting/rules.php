<?php
use yii\helpers\Url;
?>

<div class="click_battl_screen">
    <div class="container">
        <div class="row">
            <!-- click battle -->
            <div class="click_battle_main">
                <div class="main_title">
                    <h2><b>Тир</b><br/><strong>Стреляй по террористам и выигрывай призы</strong></h2>
                </div>
                <div class="cm_blocks">
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>01</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm1.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Зарегистрируйся</strong> <br>через ВКонтакте, Facebook или Google</b></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>02</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm2.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>УБИВАЙ ТЕРРОРИСТОВ, 
                            </strong> <br>НО НЕ ТРОГАЙ МИРНЫХ ЖИТЕЛЕЙ</b></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>03</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm3.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Играй снова </strong> <br>и набирай баллы</b>
                                <br>Баллы суммируются по всем твоим играм</p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>04</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch4.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Выиграй </strong> <br>Microsoft Xbox One S 500Gb</b>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <div class="cmb_buttons"> 
                    <?php if($user && $user->rules_shooting):?>
                        <a href="<?=Url::toRoute(['shooting/reg']);?>" class="scr2_text_btn transition" data-event="shot_way" data-param="play_again">Играть ещё</a>
                    <?php else:?>
                        <a href="<?=Url::toRoute(['shooting/reg']);?>" class="scr2_text_btn transition" data-event="shot_way" data-param="play">Играть</a>
                    <?php endif;?>
                    <a href="<?=Url::toRoute(['shooting/rating']);?>" class="scr2_bottom_button transition" data-event="shot_way" data-param="rating_rules">рейтинг участников</a>
                </div>
                <br/>
                <div class="cmb_buttons">
                    <a href="#rules-shooting" class="scr2_text_btn transition fancybox" data-event="shot_way" data-param="fullrules">Полные правила</a>
                </div>
            </div>
            <!-- /click battle -->
        </div>
    </div>
</div>

<?=$this->render('_rules');?>