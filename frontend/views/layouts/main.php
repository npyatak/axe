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
<div class="main_page_wrapper">
    <!-- header -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="screen_content clearfix">
                    <div class="logo"><a href="<?=Url::home();?>"><img src="/img/logo.png" alt="img"></a></div>
                    <a href="javascript:void(0)" class="transition hidden_trigger"></a>
                    <div class="right_logo"><img src="/img/logo2.png" alt="img"></div>
                    <div class="nav_list_wrapper">
                        <ul class="nav_list">
                            <li><a href="#">Мир киберспорта</a></li>
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
                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-vk"></i></a></li>
                        </ul>
                    </div>
                    <div class="footer_sponsor">
                        <p>При поддержке: <a href="#"><img src="/img/fs1.png" alt="img"></a> <a href="#"><img src="/img/fs2.png" alt="img"></a></p>
                    </div>
                    <div class="copyright">
                        <p>© 2017 Unilever. Russia. Все права защищены</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /footer -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
