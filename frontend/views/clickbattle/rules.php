<?php
use yii\helpers\Url;
?>
<div class="click_battl_screen">
    <div class="container">
        <div class="row">
            <!-- click battle -->
            <div class="click_battle_main">
                <div class="main_title">
                    <h2><b><strong>Челлендж AXE</strong> <br>на лучший игровой момент</b></h2>
                </div>
                <div class="cm_blocks">
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>01</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm1.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Зарегистрируйся и запости</strong> <br> свои лучшие игровые моменты</b>
                                <br>в виде youtube-ссылок (не более 10-ти)
                                <!--<br>и дождись модерации--></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>02</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch2.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Или размести видео </strong> <br>на youtube или во ВКонтакте <!--<br/>с лучшим игровым моментом-->  </b>
                            <br/>указав хештег #AXEgame в названии*</a>
                            <!--<br/>такие посты автоматически попадут в проект*</a>-->
                            </p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>03</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch3.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Пройди модерацию</strong> <br/>Поделись своей работой</b><br>и зови друзей голосовать в конкурсе
                            <!--<br>поделись своими работами в соц. сетях</p>-->
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>04</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch4.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Выигрывай призы</strong> <br>Sony PlayStation 4 Slim 500 ГБ</b>
                                <br>а также 15 подарочных наборов AXE</p>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <div class="cmb_buttons">
                    <a href="<?=Url::toRoute(['site/challenge-reg']);?>" class="scr2_text_btn transition">Участвовать</a>
                    <a href="<?=Url::toRoute(['site/challenge']);?>" class="scr2_bottom_button transition">голосовать</a> -->
                    
                </div>
                <!--<h2>* размещая посты на youtube во ВКонтакте с хештегом #AXEgame, участник тем самым выражает согласие с <a>полными правилами</a> конкурса</h2>-->
            </div>
            <!-- /click battle -->
        </div>
    </div>
</div>