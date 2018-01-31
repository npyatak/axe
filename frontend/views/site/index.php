<?php
use yii\helpers\Url;

if($result) {
    $share['url'] = Url::toRoute(['site/index', 'cybertest' => $result->id], true);
    $share['title_fb'] = $result->share_title_fb;
    $share['title_vk'] = $result->share_title_vk;
    $share['text'] = $result->share_text;
    $share['image_fb'] = $result->shareFbImageUrl;
    $share['image_vk'] = $result->shareVkImageUrl;

    $this->params['share'] = $share;

    $this->registerMetaTag(['property' => 'og:description', 'content' => $share['text']], 'og:description');
    $this->registerMetaTag(['property' => 'og:title', 'content' => $share['title_fb']], 'og:title');
    $this->registerMetaTag(['property' => 'og:image', 'content' => $share['image_fb']], 'og:image');
    $this->registerMetaTag(['property' => 'og:url', 'content' => $share['url']], 'og:url');
    $this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
}
?>
<!-- screen1 -->
<div class="screen1">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="scr1_frame_block_text">
                    <h2><span>01</span> смотреть</h2>
                    <p><?=$video['title'];?></p>
                </div>
                <div class="scr1_notebook">
                    <img src="/img/mac.png" alt="img">
                    <a href="<?=Url::toRoute(['site/video', 'id' => $mainPageVideoId]);?>" class="scr1_notebook_view "><img src="<?=$video['img'];?>" alt="img"><span class="play_btn"></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /screen1 -->
<!-- screen2 -->
<div class="screen2">
    <div class="container">
        <div class="row">
            <div class="screen_content">
                <div class="main_title num_block">
                    <h2><span>02</span> <b><strong>играть</strong> и выигрывать</b> </h2>
                </div>
                <div class="scr2_blocks">
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/21.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Тест : </h4>
                            <h3>«Кем бы ты был в мире Киберспорта» </h3>
                            <p><b>Призы:</b> Среди поделившихся своим результатом будет разыграно 15 подарочных наборов AXE</p>
                            <a href="<?=Url::toRoute(['/site/test']);?>" class="scr2_text_btn transition">Пройти тест</a>
                        </div>                     
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/22_3.png" alt="img">
                        </div>
                        <!-- <div class="scr2_block_text">
                            <h4>Запуск Челленджа на лучший игровой момент  </h4>
                            <h3>28 декабря 2017г  </h3>
                            <p><b>Призы:</b> Автор лучшего игрового момента получит Sony Playstation 4 Slim 500 GB
                            </p>
                        </div> -->
                        <div class="scr2_block_text">
                            <h4>Челлендж :  </h4>
                            <h3>на лучший игровой момент</h3>
                            <p><b>Главный приз:</b> Автор лучшего игрового момента получит Sony Playstation 4 Slim 500 GB
                            </p>
                            <div class="ch_buttons">
                                <a href="<?=Url::toRoute(['challenge/rules']);?>" class="scr2_text_btn transition" data-event="challenge_way" data-param="fullrules">участвовать</a>
                                <a href="<?=Url::toRoute(['challenge/index']);?>" class="scr2_bottom_button transition" data-event="challenge_way" data-param="main">галерея работ</a>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/23.png" alt="img">
                        </div>
                        <!-- <div class="scr2_block_text">
                            <h4>Запуск Кликбаттла </h4>
                            <h3>30 декабря 2017 г</h3>
                            <p><b>Призы:</b> 2 победителя Клик-баттла получат по топовой игровой мышке</p>
                        </div> -->
                        <div class="scr2_block_text">
                            <h4>Клик-баттл : </h4>
                            <h3>Тренируйся и выигрывай призы</h3>
                            <p><b>Главный приз:</b> 2 победителя Клик-баттла получат по топовой игровой мышке</p>
                            <div class="ch_buttons">
                                <a href="<?=Url::toRoute(['clickbattle/rules']);?>" class="scr2_text_btn transition" data-event="clicker_way" data-param="main">участвовать</a>
                                <a href="<?=Url::toRoute(['clickbattle/rating']);?>" class="scr2_bottom_button transition">рейтинг участников</a>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->                    
                    <!--<div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/24.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Запуск анимированого тира </h4>
                            <h3>30 января 2018 г <br/></h3>
                            <p><b>Призы:</b> Самый меткий и быстрый стрелок получит Microsoft Xbox One S 500 GB
                            </p>
                            <p></p>
                        </div>
                    </div>-->

                    <!-- block -->
                     <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/24.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Тир : </h4>
                            <h3>УБИВАЙ ВРАГОВ, НО НЕ ТРОГАЙ мирных жителей</h3>
                            <p><b>Призы:</b> Самый меткий и быстрый стрелок получит Microsoft Xbox One S 500 GB
                            </p>
                            <div class="ch_buttons">
                                <a href="<?=Url::toRoute(['shooting/rules']);?>" class="scr2_text_btn transition" data-event="shot_way" data-param="main">участвовать</a>
                                <a href="<?=Url::toRoute(['shooting/rating']);?>" class="scr2_bottom_button transition">рейтинг участников</a>
                            </div>
                        </div>
                    </div> 
                    <!-- /block -->
                </div>
                <!-- blocks -->
                 <div class="test_slide">
                    <h3>Полные правила конкурса <br/>«Открой для себя мир киберспорта»:</h3>
                </div>
                           
                <a href="#full-rules" class="scr2_bottom_button fancybox transition">Тест</a>
                <br/>
                <a href="#rules-challenge" class="scr2_bottom_button fancybox transition">Челлендж</a>
                <br/>
                <a href="#rules-clickbattle" class="scr2_bottom_button fancybox transition" data-event="shot_way" data-param="fullrules">Клик-баттл</a>
                <br/>
                <a href="#rules-shooting" class="scr2_bottom_button fancybox transition">Тир</a>
            </div>
        </div>
    </div>
</div>
<!-- /screen2 -->

<?php if($news):?>
<!-- screen3 -->
<div class="screen3">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title num_block">
                    <h2><span>03</span> <b><strong>читать</strong> Киберспортивные <br> новости Матч ТВ </b> </h2>
                </div>
                <div class="scr3_blocks">
                    <!-- block -->
                    <div class="scr3_block">
                        <div class="scr3_block_img"><img src="/img/game.jpg" alt="img"></div>
                        <h3>What is Lorem Ipsum?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <a href="#" class="transition scr3_btn">Подробнее</a>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr3_block">
                        <div class="scr3_block_img"><img src="/img/game.jpg" alt="img"></div>
                        <h3>What is Lorem Ipsum?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <a href="#" class="transition scr3_btn">Подробнее</a>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr3_block">
                        <div class="scr3_block_img"><img src="/img/game.jpg" alt="img"></div>
                        <h3>What is Lorem Ipsum?</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <a href="#" class="transition scr3_btn">Подробнее</a>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /screen3 -->
<?php endif;?>

<div class="modal_rules" id="full-rules">
    <?=$this->render('_rules');?>
</div>

<?=$this->render('../challenge/_rules');?>

<?=$this->render('../clickbattle/_rules');?>

<?=$this->render('../shooting/_rules');?>