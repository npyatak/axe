<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

use common\models\User;

if(!(Yii::$app->controller->id === 'clickbattle' && Yii::$app->controller->action->id === 'index')) {
    AppAsset::register($this);
}
?>
<?php $this->beginPage() ?> 
<!DOCTYPE html>
 <!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
 <!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
 <!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
 <!--[if (gte IE 9)|!(IE)]><!-->
 <html lang="ru">
 <!--<![endif]-->
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta name="viewport" content="width=980"> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?= Html::csrfMetaTags() ?>
    <title>Открой для себя мир киберспорта вместе с AXE</title>
    <!-- <link rel="shortcut icon" href="img/fav.png" type="image/x-icon"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"> -->     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>
<?php $user = Yii::$app->user->isGuest ? null : User::findOne(Yii::$app->user->id);?>

<?php if($_SERVER['HTTP_HOST'] != 'bothie.local'):?>
    <img src="https://ad.mail.ru/i2349.gif" style="width:0;height:0;position:absolute;visibility:hidden;" alt=""/>
    <img src="https://ad.mail.ru/i2350.gif" style="width:0;height:0;position:absolute;visibility:hidden;" alt=""/>
<?php endif;?>

<?php $this->beginBody() ?>
<!-- modal thanks -->
<div class="my-modal-thanks" id="myThanks">
    <h3 class="modal-thanks-h3">Спасибо за заявку!</h3>
    <p class="modal-thanks-p">Мы вскоре свяжемся с Вами!</p>
</div>
<!-- /modal thanks -->
<!-- modal -->
<div class="my_modal_window" id="myModal">
    <form action="mail.php" method="post" class="modal_form my_form  transition">
        <input type="hidden" name="project_name" value="">
        <input type="hidden" name="form_subject" value="Письмо с сайта  (заказ обратного звонка)">
        <h3><b>Для обратной</b> <br> связи заполните форму</h3>
        <p class="btn-center">
            <input type="text" name="Имя" placeholder="Ваше имя" class="form_input form_input_name" required>
        </p>
        <p class="btn-center">
            <input type="tel" name="Телефон" placeholder="Ваш телефон" class="form_input form_input_phone" required>
        </p>
        <p class="btn-center">
            <input type="email" name="E-mail" placeholder="Ваш e-mail " class="form_input form_input_mail" required>
        </p>
        <p class="btn-center">
            <button type="submit" class="submit_btn transition">Заказать сейчас</button>
        </p>
    </form>
</div>
<!-- /modal -->

<div class="main_page_wrapper">
    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="screen_content clearfix">
                    <div class="logo"><!--<a href="https://www.axerussia.ru/?utm_source=GPMD&utm_medium=SP&utm_content=GPMD_SP&utm_campaign=AXE_SP_GPMD_DecFeb_&utm_term=" target="_blank" data-event="logo_click" data-param="logo_axe">--><a href="/"><img src="/img/logo.png" alt="img"></a></div>
                    <a href="javascript:void(0)" class="transition hidden_trigger"></a>
                    <div class="right_logo"><a href="http://team.empire.gg/" target="_blank" data-event="logo_click" data-param="logo_TeamEmpire"><img src="/img/logo2.png" alt="img"></a></div>
                    <div class="nav_list_wrapper">
                        <ul class="nav_list">
                            <li>
                                <a href="<?=Url::toRoute(['site/video']);?>">Мир киберспорта</a>
                                <?php if(false):?>
                                <ul>
                                    <li><a href="<?=Url::toRoute(['site/video']);?>">Новости с Любовью Киберспортивной</a></li>
                                    <li><a href="<?=Url::toRoute(['site/news']);?>">Киберспортивные новости Матч ТВ</a></li>
                                </ul>
                                <?php endif;?>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Участвовать</a>
                                <ul>
                                    <li><a href="<?=Url::toRoute(['site/test']);?>">Тест</a></li>
                                    <?php if($user && $user->rules_challenge):?>
                                        <li><a href="<?=Url::toRoute(['challenge/index']);?>" data-event="challenge_way" data-param="menu">Челлендж</a></li>
                                    <?php else:?>
                                        <li><a href="<?=Url::toRoute(['challenge/rules']);?>">Челлендж</a></li>
                                    <?php endif;?>
                                    <?php if($user && $user->rules_clickbattle):?>
                                        <li><a href="<?=Url::toRoute(['clickbattle/index']);?>">Клик-баттл</a></li>
                                    <?php else:?>
                                        <li><a href="<?=Url::toRoute(['clickbattle/rules']);?>">Клик-баттл</a></li>
                                    <?php endif;?>
                                </ul>
                            </li>
                            <li><a href="<?=Url::toRoute(['profile/index']);?>">Личный кабинет</a></li>
                            <li><a href="https://www.axerussia.ru/?utm_source=GPMD&utm_medium=SP&utm_content=GPMD_SP&utm_campaign=AXE_SP_GPMD_DecFeb_&utm_term=" target="_blank">Axe</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- /header -->

    <?= $content ?>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer_images">
                <div class="fli">
                    <a href="https://www.axerussia.ru/?utm_source=GPMD&utm_medium=SP&utm_content=GPMD_SP&utm_campaign=AXE_SP_GPMD_DecFeb_&utm_term=" target="_blank">
                        <img src="/img/fl.png" alt="img">
                    </a>
                </div>
                <div class="fri">
                    <a href="https://www.axerussia.ru/?utm_source=GPMD&utm_medium=SP&utm_content=GPMD_SP&utm_campaign=AXE_SP_GPMD_DecFeb_&utm_term=" target="_blank">
                        <img src="/img/fr.png" alt="img">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="screen_content clearfix">
                    <div class="footer_soc_wrap">
                        <p>Поделиться:</p>
                        <ul class="footer_soc">
                            <?php if(isset($this->params['share'])) {
                                $share = $this->params['share'];
                            } else {
                                $share = Yii::$app->params['share'];
                                $share['url'] = Url::canonical();
                                $share['image_fb'] = Url::to($share['image_fb'], true);
                                $share['image_vk'] = Url::to($share['image_vk'], true);
                            } ?>
                            <?php
                            $this->registerMetaTag(['property' => 'og:description', 'content' => $share['text']], 'og:description');
                            $this->registerMetaTag(['property' => 'og:title', 'content' => $share['title_fb']], 'og:title');
                            $this->registerMetaTag(['property' => 'og:image', 'content' => $share['image_fb']], 'og:image');
                            $this->registerMetaTag(['property' => 'og:url', 'content' => $share['url']], 'og:url');
                            $this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
                            ?>
                            <li>
                                <?= Html::a('<i class="zmdi zmdi-facebook"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'fb',
                                    'data-url' => $share['url'],
                                    'data-title' => $share['title_fb'],
                                    'data-image' => $share['image_fb'],
                                    'data-desc' => $share['text'],
                                    'data-event' => 'main_sharing',
                                    'data-param' => 'fb'
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
                                    'data-event' => 'main_sharing',
                                    'data-param' => 'vk'
                                ]); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_sponsor">
                        <p>При поддержке: <a href="https://2x2tv.ru/" target="_blank" data-event="logo_click" data-param="logo_2-2"><img src="/img/fs1.png" alt="img"></a>
                            <a href="https://matchtv.ru/" target="_blank" data-event="logo_click" data-param="logo_MatchTV"><img src="/img/fs2.png" alt="img"></a>
                        </p>
                    </div>
                    <div class="copyright">
                        <p>© 2017 Unilever. Russia. Все права защищены</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->


    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-111266919-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->

<?php if($_SERVER['HTTP_HOST'] != 'axe.local'):?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter47039403 = new Ya.Metrika({
                        id:47039403,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/47039403" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
<?php endif;?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
