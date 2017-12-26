<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!-- reg -->
<div class="reg_screen">
    <div class="container">
        <div class="row">
            <div class="reg_screen_table">
                <div class="reg_screen_cell">
                    <div class="main_title">
                        <h2><b><strong>Запости свои лучшие видео </strong>  <br>в виде youtube-ссылок  </b><br> и участвуй в розыгрыше Sony Playstation 4 Slim 500 GB<br/> и 15 подарочных наборов AXE</h2>
                    </div>
                	<?php if(Yii::$app->user->isGuest):?>
                    	<div class="reg_screen_block">
                    		<?=$this->render('../site/_register', ['rules' => 'challenge']);?>
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
    										<div class="remove">x</div>
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
			                            <label for="rules-check">Я соглашаюсь <a href="#full-rules" class="fancybox">с полными правилами</a> конкурса</label>
			                        </div>
			                        <br/><br/>
			                    <?php endif;?>
		                        <div class="ch_buttons">
		                        	<?= Html::submitButton('запостить', ['class' => 'scr2_text_btn transition']) ?>
		                        </div>
		                    </div>
		                <?php ActiveForm::end(); ?>
		            <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /reg -->

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