<?php
use yii\helpers\Url;
?>
<div class="click_battl_screen">
    <div class="container">
        <div class="row">
            <!-- click battle -->
            <div class="click_battle_main">
                <div class="main_title">
                    <h2><b><strong>Челлендж #AXEBEST</strong> <br>на лучший игровой момент</b></h2>
                </div>
                <div class="cm_blocks">
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>01</p>
                        </div>
                        <div class="cmb_img"><img src="/img/cm1.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Зарегистрируйся и запости</strong> <br> свой лучший игровой момент</b>
                                <br>в виде youtube-ссылки
                                <!--<br>и дождись модерации--></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p style="font-size:60px;">или</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch2.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Размести видео </strong> <br>во ВКонтакте <!--<br/>с лучшим игровым моментом-->  </b>
                            <br/>указав хештег #AXEBEST в названии</a>
                            <!--<br/>такие посты автоматически попадут в проект*</a>-->
                            </p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>02</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch3.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Дождись модерации</strong> <br/>и зови друзей голосовать в конкурсе
                            <!--<br>поделись своими работами в соц. сетях</p>-->
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="cm_block">
                        <div class="cmb_num">
                            <p>03</p>
                        </div>
                        <div class="cmb_img"><img src="/img/ch4.png" alt="img"></div>
                        <div class="cmb_text">
                            <p><b><strong>Выигрывай призы</strong> <br>Sony PlayStation 4 Slim 500 ГБ</b>
                                <br>и подарочные наборы AXE</p>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <div class="cmb_buttons">
                    <a href="<?=Url::toRoute(['challenge/reg']);?>" class="scr2_text_btn transition">Участвовать</a>
                    <a href="<?=Url::toRoute(['challenge/index']);?>" class="scr2_bottom_button transition">Голосовать</a> 
                    
                </div>
            </div>
            <!-- /click battle -->

            <style>
                .rules_content h3,.rules_content h3 b,.rs_mb_descr h5{text-align:center;text-transform:uppercase}.article_block img{display:block;max-width:100%;margin-bottom:10px}.article_block b{display:block;color:#fff;font-family:BebasNeueBold;font-size:22px;margin-bottom:23px;position:relative}.article_block b:after{content:"";display:block;width:41px;height:1px;background-color:#ab9675;position:absolute;left:0;bottom:-10px}.article_block:focus,.article_block:hover{color:#fff}
                .rules_content{vertical-align:top;margin: auto;padding-right:30px;}
                .rules_content{position: relative;}
                .rules_content ul li{color:#fffffe;font-size:15px;font-family:HelveticaNeueCyr}
                .rules_content ul{padding-left:30px}
                .rules_content a{color:#fffffe;font-size:15px}
                .rules_content h3{color:#fff;font-family:BebasNeueBook;}.rules_content h3 b{text-shadow:0 3px 1px rgba(0,0,0,.64);color:#ab9675;font-family:BebasNeueBold;}.av_text,.rules_content p,.news_date{font-family:HelveticaNeueCyr}.rules_content p{color:#fffffe;font-size:17px;margin-bottom:15px}.rules_content p::after{display:block;content:"";clear:both}.rules_content p img{float:left;margin-right:15px;margin-bottom:5px}
                
                @media screen and (max-width:5000px)  {.rules_content {width:900px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
                @media screen and (max-width:1600px)  {.rules_content {width:800px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
                @media screen and (max-width:1450px)  {.rules_content {width:800px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
                @media screen and (max-width:1280px)  {.rules_content {width:800px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
                @media screen and (max-width:1100px)  {.rules_content {width:600px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
                @media screen and (max-width:768px)   {.rules_content {width:400px} .rules_content h3 {margin-bottom:10px;font-size:28px} .rules_content h3 b{font-size:35px;font-weight:400}}
            </style>
            <div class="main_video_news">
                <div class="rules_content">
                    <h3><b>КАК СТАТЬ УЧАСТНИКОМ?</b><br> Принять участие в конкурсе можно двумя способами:</h3>
                    <p>01. Загрузить видео своего лучшего игрового момента залитого на YouTube – указав ссылку.</p>
                    <h3>или</h3>
                    <p>02. Опубликовать видео своего лучшего игрового момента на своей страничке в социальной сети ВКонтакте, указав в названии поста хэштег #AXEBEST. Конкурсные работы с хэштегом будут автоматически добавляться на страницу проекта. Найти их можно через фильтр по нику на странице «Рейтинг участников».
                    <!--<p>Наглядный вариант как это сделать:</p>
                    <p>
                        <ul>
                            <li>    Постинг ссылок (<a href="">скрин</a>)</li>
                            <li>    Постинг видео с хэштегами для YouTube (<a href="">скрин</a>)</li>
                            <li>    Постинг видео с хештегами в ВКонтакте (<a href="">скрин</a>)</li>
                        </ul>
                    </p>-->
                    <h3><b>Модерация</b></h3>
                    <p>После загрузки видео необходимо дождаться прохождения модерации. После чего оно автоматически появляется в конкурсе. Модерация производится один раз в день.</p>
                    <h3><b>ФИНИШНАЯ ПРЯМАЯ</b><br></h3>
                    <p>После того как видео прошло модерацию – самое время звать друзей, чтобы они за него проголосовали. А чтобы никто из друзей не прошел мимо вашего лучшего игрового момента – его можно пошерить в соцсети. И помните - чем больше «лайков», тем ближе к победе!</p>
                    <h3><b>Призы</b></h3>
                    <p>Занявшему первое место достанется ГЛАВНЫЙ ПРИЗ: <b>Sony PlayStation 4 Slim 500 ГБ</b>!<br/>
                    А также <b>подарочные наборы AXE</b> за 2 и 3 место!</p>
                    <br/>
                    <div class="cmb_buttons">
                        <a href="<?=Url::toRoute(['challenge/reg']);?>" class="scr2_text_btn transition">Участвовать</a>
                        <a href="<?=Url::toRoute(['challenge/index']);?>" class="scr2_bottom_button transition">голосовать</a>
                    </div>
                    <br/>
                    <div class="cmb_buttons">
                        <a href="#rules-challenge" class="scr2_text_btn transition fancybox">Полные правила</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->render('_rules');?>