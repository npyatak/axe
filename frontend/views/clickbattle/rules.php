<?php
use yii\helpers\Url;
?>

<div class="click_battl_screen">
    <div class="container">
        <div class="row">
            <!-- click battle -->
            <div class="click_battle_main">
                <div class="main_title">
                    <h2><b>клик-баттл</b><br/><strong>Настоящий киберспортсмен <br/>должен уметь </strong>быстро<strong> и </strong>метко<strong> кликать</strong><br/>Усердно тренируйся и выигрывай призы</h2>
                </div>
                <div class="cm_blocks">
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>01</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm1.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Зарегистрируйся</strong> <br>через ВКонтакте или Facebook </b></p>
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
                            <p><b><strong>Выбери</strong> <br>«мишень» для тренировки</b></p>
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
                            <p><b><strong>Покажи, как быстро и метко </strong> <br>ты умеешь кликать  </b></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>04</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm4.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Выиграй </strong> <br>топовые игровые мышки</b>
                                <br>а также 5 подарочных наборов AXE</p>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <div class="cmb_buttons"> 
                    <?php if($user && $user->rules_clickbattle):?>
                        <a href="<?=Url::toRoute(['clickbattle/reg']);?>" class="scr2_text_btn transition" data-event="clicker_way" data-param="play_again">Играть ещё</a>
                    <?php else:?>
                        <a href="<?=Url::toRoute(['clickbattle/reg']);?>" class="scr2_text_btn transition" data-event="clicker_way" data-param="play">Играть</a>
                    <?php endif;?>
                    <a href="<?=Url::toRoute(['clickbattle/rating']);?>" class="scr2_bottom_button transition" data-event="clicker_way" data-param="rating_rules">рейтинг участников</a>
                </div>
                <br/>
                <div class="cmb_buttons">
                    <a href="#rules-clickbattle" class="scr2_text_btn transition fancybox" data-event="clicker_way" data-param="fullrules">Полные правила</a>
                </div>
            </div>
            <!-- /click battle -->
        </div>
    </div>
</div>

<?=$this->render('_rules');?>