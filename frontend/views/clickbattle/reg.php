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
	                        <h2><b><strong>Зарегистрируйся в проекте</strong> <br> Кликай лучше других </b> <br> и получи топовую игровую мышь в подарок</h2>
	                    </div>
	                    <div class="reg_screen_block">
                    		<?=$this->render('../site/_register', ['ref' => Url::toRoute(['clickbattle/index']), 'rules' => 'clickbattle']);?>
	                    </div>
                	<?php else:?>
	                    <div class="main_title">
	                        <h2><b>Кликай лучше других</b><br>и получи топовую игровую мышь в подарок </h2>
	                    </div>
	                    <div class="reg_screen_block">
	                        <div class="reg_screen_check">
	                            <input type="checkbox" id="rch1" name="reg" checked>
	                            <label for="rch1">Я соглашаюсь <a href="#rules-clickbattle" class="fancybox" data-event="clicker_way" data-param="fullrules_submit">с полными правилами</a> конкурса</label>
	                        </div>
	                        <br/><br/>
	                        <div class="ch_buttons">
	                            <a href="<?=Url::toRoute(['clickbattle/index']);?>" class="scr2_text_btn transition">Играть</a>
	                        </div>
	                    </div>
	                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->render('_rules');?>