<?php
use yii\helpers\Url;
?>
<div class="reg_screen">
    <div class="container">
        <div class="row">
            <div class="reg_screen_table">
                <div class="reg_screen_cell">
                    <div class="main_title">
                        <h2><b><strong>Спасибо!</strong> <br>После успешной модерации <br>видео появится в галерее работ</b><br> поделись своим видео и набирай лайки</h2>
                    </div>
                    
                    <br/>
                    
                    <div class="reg_screen_block">
                        <div class="ch_buttons">
                       	    <a href="<?=Url::toRoute(['/challenge/index']);?>" class="scr2_text_btn transition">галерея работ</a>
                            <a href="<?=Url::toRoute(['/profile/index']);?>" class="scr2_bottom_button transition">Личный кабинет</a>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>