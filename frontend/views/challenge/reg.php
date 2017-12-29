<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="reg_screen">
    <div class="container">
        <div class="row">
            <div class="reg_screen_table">
                <div class="reg_screen_cell">
                    <div class="main_title">
                        <h2>
                        	<?php if(Yii::$app->user->isGuest):?>
                        		<b><strong>авторизуйся и загрузи</strong>  <br>видео своего лучшего игрового момента</b><br> и поборись за sony playstation 4 slim 500gb
                        	<?php else:?>
								<b><strong>ВСТАВЬ ССЫЛКУ</strong> <br>НА ВИДЕО ТВОЕГО ЛУЧШЕГО</b><br> ИГРОВОГО МОМЕНТА НА YOUTUBE
                        	<?php endif;?>
                        </h2>
                    </div>
                	<?php if(Yii::$app->user->isGuest):?>
                    	<div class="reg_screen_block">
                    		<?=$this->render('../site/_register', ['ref' => Url::current(), 'rules' => 'challenge']);?>
	                    </div>
                	<?php else:?>
    					<?php $form = ActiveForm::begin([
    						'enableClientValidation' => false,
    						'enableAjaxValidation' => true,
    						'options' => [
    							'class' => 'form_plus_param',
    							'id' => 'challenge-form'
    						]
    					]); ?>
		                    <div class="reg_screen_link">
		                    	<div class="input-rows">
		                    	<?php foreach ($challenges as $key => $challenge):?>
        							<?php $challenge->scenario = 'userNew';?>
									<div class="reg_screen_input_div">
										<div class="reg_screen_text form-group <?=$challenge->hasErrors("link") ? 'has-error' : '';?>" data-number="<?=$key;?>">
											<?= Html::activeLabel($challenge, "[$key]link", ['class' => 'reg_screen_text']) ?>
											<?= Html::activeTextInput($challenge, "[$key]link", ['class' => 'reg_screen_input']) ?>
    										<div class="remove"><img src="/img/x.png" alt="img"></div>
											<?= Html::error($challenge, "[$key]link", ['class' => 'help-block']);?>
										</div>
									</div>	
								<?php endforeach;?>
								</div>
								<div class="reg_screen_block">
							        <div class="ch_buttons">
							            <a class="reg_screen_plus transition" id="form_plus_added">Ещё одно видео</a>
							        </div>
					            </div>
								<br/><br/>
		                    </div>
	                    	<div class="reg_screen_block">
	                    		<?php $user = Yii::$app->user->identity;?>
	                    		<?php if(!$user->rules_challenge):?>
			                        <div class="reg_screen_check">
			                            <input type="checkbox" id="rules-check" name="reg" checked>
			                            <label for="rules-check">Я соглашаюсь <a href="#rules-challenge" class="fancybox" data-event="challenge_way" data-param="fullrules_submit">с полными правилами</a> конкурса</label>
			                        </div>
			                        <br/><br/>
			                    <?php endif;?>
		                        <div class="ch_buttons">
		                        	<?= Html::submitButton('запостить', ['class' => 'scr2_text_btn transition', ' data-event' => 'clickbattle_way', 'data-param' => 'fullrules_submit']) ?>
		                        </div>
		                    </div>
		                <?php ActiveForm::end(); ?>
		            <?php endif;?>
		            
		            
		            <style>
		            		.qa_text {position: relative;vertical-align:top;margin: auto;text-align: center;}
		            		.q_text {
		            			text-shadow: 0 3px 1px rgba(0,0,0,.64);
    									color: #ab9675;
    									font-family: BebasNeueBold;
		            		}
		            		.q_text a {
		            			
		            			color: #fff;
    									text-decoration: underline;
    									font-family: BebasNeueBold;
		            		}
		            		.q_text span {
		            			
		            			color: #fff;
    									font-family: BebasNeueBold;
		            		}
		            		@media screen and (max-width:5000px)  {.qa_text {width: 600px; font-size: 22px;} .q_text a span {font-size: 22px;} }
										@media screen and (max-width:1600px)  {.qa_text {width: 500px; font-size: 20px;} .q_text a span {font-size: 20px;} }
										@media screen and (max-width:1450px)  {.qa_text {width: 450px; font-size: 18px;} .q_text a span {font-size: 18px;} }
										@media screen and (max-width:1280px)  {.qa_text {width: 400px; font-size: 16px;} .q_text a span {font-size: 16px;} }
										@media screen and (max-width:1100px)  {.qa_text {width: 350px; font-size: 16px;} .q_text a span {font-size: 16px;} }
										@media screen and (max-width:768px)   {.qa_text {width: 300px; font-size: 16px;} .q_text a span {font-size: 16px;} }
		            </style>
		            <br/>
		            <br/>
		            <div class="qa_text">
                		<label class="q_text">А если вы уже опубликовали свой лучший игровой момент по хэштегу <span>#AXEBEST</span> во &laquo;ВКонтакте&raquo; – найдите своё видео в <a href="/challenge">галерее работ</a>, используя поиск по нику.</label>
                </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>

<?=$this->render('_rules');?>

<?php
$script = "
	$(document).on('click', '#form_plus_added', function(e) {
		var newInput = $('.reg_screen_input_div:first').clone();

		newInput.find('input').val('');
		newInput.find('.help-block').html('');
		var count = $('.reg_screen_input_div').length;
		var newHtml = newInput.html().replace(/0/g, count);
		newInput.html(newHtml);
		$('.input-rows').append(newInput);
	});
";

$this->registerJs($script, yii\web\View::POS_END);?>