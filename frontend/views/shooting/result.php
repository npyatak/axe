<?php
use yii\helpers\Url;
?>

<div class="shot_screen_game">
	<div class="container">
		<div class="row">
			<div class="reg_screen_table">
				<div class="reg_screen_cell">
					<div class="shot_screen_game_start">
						<div class="shot_screen_block_alert">
							<h3><b>Внимание!</b> для прохождения игры, Вам необходимо перевернуть телефон в горизонтальное положение.</h3>
						</div>
						<div class="shot_screen_block">
							<h3>TO BE CONTINUED...</h3>
							<h4> <b>Ты заработал</b> <?=$result->score;?> <b>баллов</b></h4>
							<style>
								.second_text_shoot_end {
									font-family: BebasNeueRegular;
									color: #777;
									font-size: 24px;
								}
								.second_text_shoot_end2 {
									font-family: BebasNeueRegular;
									color: #777;
									font-size: 18px;
								}
							</style>
							<p><span class="second_text_shoot_end">Чем больше попыток – тем выше шансы получить главный приз</span></p>
							<p><span class="second_text_shoot_end2">в рейтинге баллы суммируются по всем твоим играм</span></p>
							<br/><br/><br/>
							<div class="cb_reslt_buttons">
								<a href="<?=Url::toRoute(['shooting/index']);?>" id="play_again" class="transition cb_reslt_button hovered" data-event="clicker_way" data-param="play_again_game">Попробовать еще раз</a>
								<a href="<?=Url::toRoute(['shooting/rating']);?>" class="transition cb_reslt_button" data-event="clicker_way" data-param="rating_game">Рейтинг участников</a>
							</div>
						</div>

					</div>
					<!-- /end -->
				</div>
			</div>
		</div>
	</div>
</div>

<?php $script = "
	$('#play_again').click(function(e) {
		elem = $(this);
        $.ajax({
        	url: '".Url::toRoute(['shooting/play-again'])."',
            success: function(data) {
                window.location.href = elem.attr('href');
            }
        });

        return false;
	})
";

$this->registerJs($script, yii\web\View::POS_END);?>