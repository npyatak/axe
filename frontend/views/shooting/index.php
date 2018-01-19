<?php
use yii\helpers\Url;

\frontend\assets\ShootingAsset::register($this);
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
					<div class="shot_screen_game_start" id="shot_game_screen1">
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
					<div class="shot_screen_game_wrapper" id="shot_game_screen2">
						<div class="game_block_stat">
							<div class="game_block_sound">
								<p class="sound-off"><img src="/img/sound_off.png" alt="Звук отключен"></p>
								<p class="sound-on"><img src="/img/sound_on.png"  alt="Звук включен"></p>
							</div>
							<div class="game_block_stat_res">
								<p>0 баллов</p>
							</div>
							<div class="game_block_stat_time">
								<p>120 сек</p>
							</div>
						</div>
						<div class="sg_img">
							<div class="main_house">
								<!-- <img src="img/house.png" alt="img"> -->
								<img src="img/house2.jpg" alt="img">
							</div>
							<div class="game_warriors game_warrior1"><img src="img/w1.png" alt="img"></div>
							<div class="game_warriors game_warrior2"><img src="img/w2.png" alt="img"></div>
							<div class="game_warriors game_warrior3"><img src="img/w3.png" alt="img"></div>
							<div class="game_warriors game_warrior3a"><img src="img/w3a.png" alt="img"></div>
							<div class="game_warriors game_warrior4"><img src="img/w4.png" alt="img"></div>
							<div class="game_warriors game_warrior5"><img src="img/w5.png" alt="img"></div>
							<div class="game_warriors game_warrior6"><img src="img/w6.png" alt="img"></div>
							<div class="game_warriors game_warrior7"><img src="img/w7.png" alt="img"></div>
							<div class="game_warriors game_warrior8"><img src="img/w8.png" alt="img"></div>
							<div class="game_warriors game_warrior8a"><img src="img/w8a.png" alt="img"></div>
							<div class="game_warriors game_warrior9"><img src="img/w9.png" alt="img"></div>
							<div class="game_warriors game_warrior9a"><img src="img/w9a.png" alt="img"></div>
							<div class="game_warriors game_warrior10"><img src="img/w10.png" alt="img"></div>
							<div class="game_warriors game_warrior11"><img src="img/w11.png" alt="img"></div>
							<div class="game_warriors game_warrior12">
								<div class="game_warriors_glass"><img src="img/glass1.png" alt="img"></div>
								<img src="img/w12.png" alt="img">
							</div>
							<div class="game_warriors game_warrior13">
								<!-- <div class="game_warriors_glass"><img src="img/glass2.png" alt="img"></div> -->
								<img src="img/w13_2.png" alt="img">
							</div>
							<div class="game_warriors game_warrior14">
								<div class="game_warriors_glass"><img src="img/glass1.png" alt="img"></div>
								<img src="img/w14.png" alt="img">
							</div>
							<div class="game_warriors game_warrior15">
								<!-- <div class="game_warriors_glass"><img src="img/glass2.png" alt="img"></div> -->
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
					<!-- end -->
					<div class="shot_screen_game_start" id="shot_game_screen3">
						<div class="shot_screen_block_alert">
							<h3><b>Внимание!</b> для прохождения игры, Вам необходимо перевернуть телефон в горизонтальное положение.</h3>
						</div>
						<div class="shot_screen_block">
							<h3>TO BE CONTINUED...</h3>
							<h4> <b>Ты заработал</b> 0 <b>баллов</b></h4>
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
								<a href="/shooting" class="transition cb_reslt_button hovered" data-event="clicker_way" data-param="play_again_game">Попробовать еще раз</a>
								<a href="/shooting/rating" class="transition cb_reslt_button" data-event="clicker_way" data-param="rating_game">Рейтинг участников</a>
							</div>
						</div>

					</div>
					<!-- /end -->
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	const timeGame = <?=$params['timeGame'];?>//время игры
	const timeLifeWarrior = <?=$params['timeLifeWarrior'];?>//время отображения warrior
	const timeBeforeShowWarrior = <?=$params['timeBeforeShowWarrior'];?>//время перед отображением следующего warrior
	const timeAnimationShowWarrior = <?=$params['timeAnimationShowWarrior'];?>//время анимации появления warrior
	const timeAnimationHideWarrior = <?=$params['timeAnimationHideWarrior'];?>//время анимации скрытия warrior
	const pointsPlus = <?=$params['pointsPlus'];?>//очков за верный выстрел
	const pointsMinus = <?=$params['pointsMinus'];?>//очков за не верный выстрел
</script>
<?php $script = "
	$(document).ready(function(e) {
		ga('send', 'event', 'shot_way', 'game');
	});
";

$this->registerJs($script, yii\web\View::POS_END);?>