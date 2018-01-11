<?php
use yii\helpers\Url;

\frontend\assets\ClickbattleAsset::register($this);
?>

<div class="clickbattle_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Клик-баттл</strong></b></h2>
                </div>
                <div class="clickbattle_game_wrapper">
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table1" style="background: url(/img/bg_game.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <div class="enemy_blocks">
                                <h4>Танки, Орки или М-16?<br/><b>Выбери что тебе по душе и сделай как можно больше точных кликов</b></h4>
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/tank.png" alt="img">
                                    </div>
                                    <a href="#" data-icon="tank" class="enemy_block_button transition" data-event="clicker_way" data-param="play_tank">Выбрать</a>
                                </div>
                                <!-- /block -->
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/axe.png" alt="img">
                                    </div>
                                    <a href="#" data-icon="axe" class="enemy_block_button transition" data-event="clicker_way" data-param="play_ork">Выбрать</a>
                                </div>
                                <!-- /block -->
                                <!-- block -->
                                <div class="enemy_block">
                                    <div class="enemy_block_img">
                                        <img src="/img/weapon.png" alt="img">
                                    </div>
                                    <a href="#" data-icon="weapon" class="enemy_block_button transition" data-event="clicker_way" data-param="play_ak47">Выбрать</a>
                                </div>
                                <!-- /block -->
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table2" style="background: url(/img/bg_game.jpg) center no-repeat; background-size: cover;">
                        <div class="cb_game_cell">
                            <a href="#" class="transition start_bame_btn">Нажмите чтобы начать</a>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="game_block" id="game_block">
                        <!--<div class="bame_el game_el1" style="top: 290px; left:  107px;"><img src="/img/gl1.png" alt="img"></div>
                        <div class="bame_el game_el2" style="top: 164px; right: 112px"><img src="/img/gl2.png" alt="img"></div>-->
                        <!-- <div class="bame_el game_el3" style="top: 73px; right: 212px"><img src="/img/shot.png" alt="img"></div> -->

                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table4">
                        <div class="cb_game_cell">
                            <div class="cb_game_reslt">
                                <div class="cb_reslt_heading">
                                    <h4>Game Over</h4>
                                    <p>Ты заработал <b id="score"></b></p>
                                </div>
                                <div class="cb_reslt_buttons">
                                    <a href="<?=Url::toRoute(['clickbattle/index']);?>" class="transition cb_reslt_button hovered" data-event="clicker_way" data-param="play_again_game">Попробовать еще раз</a>
                                    <a href="<?=Url::toRoute(['clickbattle/rating']);?>" class="transition cb_reslt_button" data-event="clicker_way" data-param="rating_game">Рейтинг участников</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <!-- /end of game -->
                <!-- warning message -->
                <div class="game_warning_message">
                    <p><b>Для прохождения игры,</b>
                        <br> пожалуйста, воспользуйся десктоп-версией сайта</p>
                </div>
                <!-- /warning message -->
                <div class="clickbattle_bottom">
                    <div class="clickbattle_bottom_text">
                        <p>Играй, зарабатывай баллы и выигрывай топовые игровые мышки, а так же
                            <br> подарочные наборы AXE. </p>
                        <p><b>Итоги конкурса будут подведены не позднее «14» февраля 2018 г. </b></p>
                    </div>
                    <div class="clickbattle_bottom_img"><img src="/img/mouse.png" alt="img"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const radius = <?=$params['radius'];?>;
        const halfImageWidth = <?=$params['halfImageWidth'];?>;
        const delayInterval = parseInt(<?=$params['delayInterval'];?>);
        const targetLifeDurationInterval = parseInt(<?=$params['targetLifeDurationInterval'];?>);
        const timerTextInterval = 1000;
        const endGameTime = <?=$params['endGameTime'];?>;

        var targets = <?=json_encode($data);?>;

        $(document).ready(function(e) {
            ga('send', 'event', 'cliker_way', 'game');
        });
    </script>
</div>

