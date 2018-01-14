<?php
use yii\helpers\Url;
?>

<div class="shot_screen_game">
    <div class="container">
        <div class="row">
            <div class="reg_screen_table">
                <div class="reg_screen_cell">
                    <div class="main_title">
                        <h2><b><strong>Анимированный тир</strong></b></h2>
                    </div>
                    <!-- start -->
                    <div class="shot_screen_game_start">
                        <div class="shot_screen_block_alert">
                            <h3><b>Внимание!</b> для прохождения игры, Вам необходимо перевернуть телефон в горизонтальное положение.</h3>
                        </div>
                        <div class="shot_screen_block">
                            <h3>Убивай "врагов", но не трогай "друзей"</h3>
                            <h4> <b>Главный приз:</b> Самый меткий и быстрый стрелок получит <br> Microsoft Xbox One S 500 GB </h4>
                            <div class="shot_axe_label"><img src="img/axe.png" alt="img"></div>
                            <a href="#" class="shot_play_btn transition">Играть</a>
                        </div>
                        <div class="ssgs_left"><img src="img/ss1.png" alt="img"></div>
                        <div class="ssgs_right"><img src="img/ss2.png" alt="img"></div>
                    </div>
                    <!-- /start -->
                    <div class="shot_screen_game_wrapper">
                        <div class="game_block_stat">
                            <div class="game_block_stat_res">
                                <p>1234 баллов</p>
                            </div>
                            <div class="game_block_stat_time">
                                <p>120 сек</p>
                            </div>
                        </div>
                        <div class="sg_img">
                            <div class="main_house">
                                <img src="img/house.png" alt="img">
                            </div>
                            <div class="game_warriors game_warrior1"><img src="img/w1.png" alt="img"></div>
                            <div class="game_warriors game_warrior2 hidden"><img src="img/w2.png" alt="img"></div>
                            <div class="game_warriors game_warrior3"><img src="img/w3.png" alt="img"></div>
                            <div class="game_warriors game_warrior3a hidden"><img src="img/w3a.png" alt="img"></div>
                            <div class="game_warriors game_warrior4"><img src="img/w4.png" alt="img"></div>
                            <div class="game_warriors game_warrior5"><img src="img/w5.png" alt="img"></div>
                            <div class="game_warriors game_warrior6"><img src="img/w6.png" alt="img"></div>
                            <div class="game_warriors game_warrior7 hidden"><img src="img/w7.png" alt="img"></div>
                            <div class="game_warriors game_warrior8"><img src="img/w8.png" alt="img"></div>
                            <div class="game_warriors game_warrior8a hidden"><img src="img/w8a.png" alt="img"></div>
                            <div class="game_warriors game_warrior9 hidden"><img src="img/w9.png" alt="img"></div>
                            <div class="game_warriors game_warrior9a hidden"><img src="img/w9.png" alt="img"></div>
                            <div class="game_warriors game_warrior10 hidden"><img src="img/w10.png" alt="img"></div>
                            <div class="game_warriors game_warrior11 hidden"><img src="img/w11.png" alt="img"></div>
                            <div class="game_warriors game_warrior12 hidden"><img src="img/w12.png" alt="img"></div>
                            <div class="game_warriors game_warrior13 hidden"><img src="img/w13.png" alt="img"></div>
                            <div class="game_warriors game_warrior14">
                                <div class="game_warriors_glass"><img src="img/glass1.png" alt="img"></div>
                                <img src="img/w14.png" alt="img">
                            </div>
                            <div class="game_warriors game_warrior15">
                                <div class="game_warriors_glass"><img src="img/glass2.png" alt="img"></div>
                                <img src="img/w15.png" alt="img">
                            </div>
                        </div>
                    </div>
                    <!-- warning message -->
                    <!--  <div class="game_warning_message">
                        <p><b>Для прохождения игры,</b>
                            <br> пожалуйста, воспользуйся десктоп-версией сайта</p>
                    </div> -->
                    <!-- /warning message -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php $script = "
    $(document).ready(function(e) {
        ga('send', 'event', 'shot_way', 'game');
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>