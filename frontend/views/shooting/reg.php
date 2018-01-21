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
                	<?php if(!$user):?>
	                    <div class="main_title">
	                        <h2><b><strong>Зарегистрируйся в проекте</strong> <br> УБИВАЙ ТЕРРОРИСТОВ, НО НЕ ТРОГАЙ МИРНЫХ ЖИТЕЛЕЙ
  <br><b>и получи Microsoft Xbox One S 500 GB</b></h2>
	                    </div>
	                    <div class="reg_screen_block">
                    		<?=$this->render('../site/_register', ['ref' => Url::toRoute(['shooting/index']), 'rules' => 'shooting']);?>
	                    </div>
                	<?php else:?>
	                    <div class="main_title">
	                        <h2><b>УБИВАЙ ТЕРРОРИСТОВ, НО НЕ ТРОГАЙ МИРНЫХ ЖИТЕЛЕЙ</b><br>и получи Microsoft Xbox One S 500 GB</h2>
	                    </div>
	                    <div class="reg_screen_block">
	                        <div class="reg_screen_check">
	                            <input type="checkbox" id="rch1" name="reg" checked>
	                            <label for="rch1">Я соглашаюсь <a href="#rules-shooting" class="fancybox" data-event="shot_way" data-param="fullrules_submit">с полными правилами</a> конкурса</label>
	                        </div>
	                        <br/><br/>
	                        <div class="ch_buttons">
	                            <a href="<?=Url::toRoute(['shooting/index']);?>" class="scr2_text_btn transition">Играть</a>
	                        </div>
	                    </div>
	                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->render('_rules');?>