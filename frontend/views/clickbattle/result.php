<?php
use yii\helpers\Url;
?>

<div class="clickbattle_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Клик-баттл</strong></b></h2>
                </div>
                <div class="clickbattle_game_wrapper">
                    <div class="cb_game_table">
                        <div class="cb_game_cell">
                            <div class="cb_game_reslt">
                                <div class="cb_reslt_heading">
                                    <h4>TO BE CONTINUED...</h4>
                                    <p>Ты заработал <b id="score"><?=$result->score;?> <?=$result->scoreText;?></b></p>
                                    <style>
                            						.second_text_click_end {
                    												    			color: #777;
                    												    			font-size: 24px;
                    															}
                    															.second_text_click_end2 {
                    												    			color: #777;
                    												    			font-size: 18px;
                    															}
                            				</style>
                                    <p><span class="second_text_click_end">Чем больше попыток – тем выше шансы получить главный приз</span></p>
                                    <p><span class="second_text_click_end2">в рейтинге баллы суммируются по всем твоим играм</span></p>
                                </div>
                                <div class="cb_reslt_buttons">
                                    <a href="<?=Url::toRoute(['clickbattle/index']);?>" class="transition cb_reslt_button hovered" data-event="clicker_way" data-param="play_again_game">Попробовать еще раз</a>
                                    <a href="<?=Url::toRoute(['clickbattle/rating']);?>" class="transition cb_reslt_button" data-event="clicker_way" data-param="rating_game">Рейтинг участников</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>