<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
                            		<style>
                            			.second_text_click {
																	    color: #fff;
																	    font-family: BebasNeueRegular;
																	    font-size: 22px;
																	}
                            		</style>
                                <h4>Танки, Орки или М-16?<br/><span class="second_text_click">Выбери что тебе по душе и сделай как можно больше точных кликов</span></h4>
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
                        <!-- <div class="bame_el game_el3" style="top: 73px; right: 212px"><img src="/img/shot.png" alt="img"></div> -->
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cb_game_table" id="cb_game_table4" style="text-align: center;">                    
                        <div class="cb_game_cell">
                            <div class="cb_game_reslt">
                                <?php $form = ActiveForm::begin(['id' => 'score_form']); ?>
                                    <?= $form->field($model, 'client_score')->hiddenInput()->label(false) ?>
                                    <?= $form->field($model, 'clicks')->hiddenInput()->label(false) ?>
                                    <?= $form->field($model, 'targets')->hiddenInput()->label(false) ?>

                                    <?php if($params['gamesWithoutCaptcha'] < $gamesCount):?>
                                        <h4>Подтверди, что ты не робот для продолжения</h4>
                                        <?= $form->field($model, 'reCaptcha', ['template' => '{input}'])->widget(\himiklab\yii2\recaptcha\ReCaptcha::className(), [
                                            'jsCallback' => 'reCaptchaResponse',
                                        ]) ?>
                                    <?php endif;?>
                                <?php ActiveForm::end(); ?>
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
                        <p>Играй, зарабатывай баллы и выигрывай топовые игровые мышки 
                            <br> и другие ценные призы </p>
                        <p><b>Итоги конкурса будут подведены не позднее «14» февраля 2018 г </b></p>
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
    </script>
</div>

<?php $script = "
    $(document).ready(function(e) {
        ga('send', 'event', 'clicker_way', 'game');
    });
    
    var reCaptchaResponse = function() {
        $('#score_form').submit();
    }
";

$this->registerJs($script, yii\web\View::POS_END);?>