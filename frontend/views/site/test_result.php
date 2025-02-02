<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
?>

<div class="results_screen">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Результаты теста</strong> <br> &laquo;Кем бы ты был в мире киберспорта&raquo;</b></h2>
                </div>
                <h4><?=$result->title;?></h4>
                <p><?=$result->text;?></p>
                                        
                <?php if(Yii::$app->user->isGuest):?>
                    <br><br><br><br>
                    <!--<div class="reg_screen_check">-->
                    <p style="font-size:120%;">
                        <b style="color: #ab9675;">Авторизуйтесь</b> через одну из соцсетей, <b style="color: #ab9675;">поделитесь</b> своим результатом с друзьями
                        <br>
                        И получите возможность выиграть один из 15 подарочных наборов AXE
                    </p>
                    <!--</div>-->
                    <br>

                    <div class="rs_mb_img"><img src="/img/pic/n<?=$result->id;?>.png" alt="img"></div>
                    
                    <?=$this->render('_register');?>
                <?php else:?>
                    <div class="rs_mb_descr">
                        <h5><b style="color: #ab9675;">Поделитесь</b> своим результатом с друзьями <br> и получите возможность выиграть один из 15 подарочных наборов AXE</h5>
                        <ul class="footer_soc">
                            <li>
                                <?= Html::a('<i class="zmdi zmdi-facebook"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'fb',
                                    'data-url' => $share['url'],
                                    'data-title' => $share['title_fb'],
                                    'data-image' => $share['image_fb'],
                                    'data-desc' => $share['text'],
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_fb'
                                ]); ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="zmdi zmdi-vk"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'vk',
                                    'data-url' => $share['url'],
                                    'data-title' => $share['title_vk'],
                                    'data-image' => $share['image_vk'],
                                    'data-desc' => $share['text'],
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_vk'
                                ]); ?>
                            </li>
                        </ul>
                        <p>Итоги конкурса будут подведены 12 февраля 2017 г.</p>
                    </div>
                    <br/>
                    <div class="ucb_challenge_buttons">
                        <a href="<?=Url::toRoute(['profile/index']);?>" class="transition filed" data-event="test_way" data-param="result_lk">Личный кабинет</a>
                    </div>

                    <div class="rs_mb_img"><img src="/img/pic/n<?=$result->id;?>.png" alt="img"></div>

                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="screen2 result_block">
    <div class="container">
        <div class="row">
            <div class="screen_content">
                <div class="main_title">
                    <h2><b><strong>играть</strong>  и выигрывать </b></h2>
                </div>
                <div class="scr2_blocks ">
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/22_3.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Челлендж</h4>
                            <h3>на лучший игровой момент</h3>
                            <p><b>Призы:</b> Автор лучшего игрового момента получит Sony Playstation 4 Slim 500 GB
                            </p>
                            <a href="/challenge/rules" class="scr2_text_btn transition">Участвовать</a>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/23.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Клик-баттл </h4>
                            <h3>Усердно тренируйся и выигрывай призы</h3>
                            <p><b>Призы:</b> 2 победителя Клик-баттла получат по топовой игровой мышке</p>
                            <a href="/clickbattle/rules" class="scr2_text_btn transition">Играть</a>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="scr2_block">
                        <div class="scr2_block_img">
                            <img src="/img/24.png" alt="img">
                        </div>
                        <div class="scr2_block_text">
                            <h4>Тир </h4>
                            <h3>Убивай врагов, но не<br/> трогай мирных жителей</h3>
                            <p><b>Призы:</b> Самый меткий и быстрый стрелок получит Microsoft Xbox One S 500 GB
                            </p>
                            <a href="/shooting/rules" class="scr2_text_btn transition">Играть</a>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <!-- blocks -->
            </div>
        </div>
    </div>
</div>

<div class="modal_rules" id="full-rules">
    <?=$this->render('_rules');?>
</div>