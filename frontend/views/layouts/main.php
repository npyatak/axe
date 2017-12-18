<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

  <!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-111266919-1', 'auto');
</script>
<!-- End Google Analytics -->

<div class="main_page_wrapper">
    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="screen_content clearfix">
                    <div class="logo"><a href="http://www.axerussia.ru/" targer="_blank" data-event="logo_click" data-param="logo_axe"><img src="/img/logo.png" alt="img"></a></div>
                    <a href="javascript:void(0)" class="transition hidden_trigger"></a>
                    <div class="right_logo"><a href="http://team.empire.gg/" target="_blank" data-event="logo_click" data-param="logo_TeamEmpire"><img src="/img/logo2.png" alt="img"></a></div>
                    <div class="nav_list_wrapper">
                        <ul class="nav_list">
-                            <li><a href="#">Мир киберспорта</a>
-                                <ul>
-                                    <li><a href="<?=Url::toRoute(['site/video']);?>">Новости с Любовью Киберспортивной</a></li>
-                                    <li><a href="<?=Url::toRoute(['site/news']);?>">Киберспортивные новости Матч ТВ</a></li>
-                                </ul>
-                            </li>
                            <li><a href="<?=Url::toRoute(['site/test']);?>">Участвовать</a></li>
                            <li><a href="<?=Url::toRoute(['profile/index']);?>">Личный кабинет</a></li>
                            <li><a href="http://www.axerussia.ru/" targer="_blank">Axe</a></li>
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
                    <a href="http://www.axerussia.ru/" targer="_blank">
                        <img src="/img/fl.png" alt="img">
                    </a>
                </div>
                <div class="fri">
                    <a href="http://www.axerussia.ru/" targer="_blank">
                        <img src="/img/fr.png" alt="img">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="screen_content clearfix">
                    <div class="footer_soc_wrap">
                        <p>Поделиться:</p>
                        <ul class="footer_soc">
                            <li><a href="#" data-event="main_sharing" data-param="vk"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#" data-event="main_sharing" data-param="fb"><i class="zmdi zmdi-vk"></i></a></li>
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
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
