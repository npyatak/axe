<?php 
use yii\helpers\Url;
use yii\helpers\Html;

if($result) {
    $url = Url::toRoute(['site/test-result']);
    $title = $result->title;
    $text = $result->share_text;
    $image = $result->share_image;

    $this->registerMetaTag(['property' => 'og:description', 'content' => $text], 'og:description');
    $this->registerMetaTag(['property' => 'og:title', 'content' => $title], 'og:title');
    $this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
    $this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
    $this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
}
?>

<div class="personal_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <?php if($user):?>
                    <div class="user_block_wrapper">
                        <div class="user_block_photo">
                            <img src="<?=$user->image;?>" alt="img">
                        </div>
                        <div class="user_block_info">
                            <h4><?=$user->fullName;?></h4>
                            <?php if($user->city):?>
                                <p><?=$user->city;?> <i class="zmdi zmdi-pin"></i></p>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif;?>
                <div class="user_challanges">
                    <!-- block -->
                    <div class="user_challange_block filled">
                        <div class="ucb_challenge">
                            <h4>Тест :<br><b>«Кем бы ты был в мире Киберспорта»</b></h4>
                            <p><b>Призы:</b> Среди поделившихся своим результатом будет разыграно 15 подарочных наборов AXE </p>
                            <div class="ucb_challenge_buttons">
                                <?php if($user && $user->test_result_id):?>
                                <a href="<?=Url::toRoute(['site/test-result']);?>" class="transition filed" data-event="test_way" data-param="result">Результат</a>
                                <a href="<?=Url::toRoute(['site/test']);?>" class="transition" data-event="test_way" data-param="again">пройти еще раз</a>
                                <?php else:?>
                                <a href="<?=Url::toRoute(['site/test']);?>" class="transition">Пройти тест</a>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php if($user && $user->test_result_id):?>
                        <div class="ucb_challenge_share">
                            <p>Поделиться результатом: 
                                <?= Html::a('<i class="zmdi zmdi-facebook"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'fb',
                                    'data-url' => Url::toRoute(['site/test-result']),
                                    'data-title' => $title,
                                    'data-image' => $image,
                                    'data-desc' => $text,
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_lk_fb'
                                ]); ?>

                                <?= Html::a('<i class="zmdi zmdi-vk"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'vk',
                                    'data-url' => Url::toRoute(['site/test-result']),
                                    'data-title' => $title,
                                    'data-image' => $image,
                                    'data-desc' => $text,
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_lk_vk'
                                ]); ?>
                            </p>
                        </div>
                        <?php endif;?>
                        <div class="clng_img"><img src="/img/clng.png" alt="img"></div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="user_challange_block">
                        <div class="ucb_title">
                            <p>Запуск челенджа на лучший игровой момент
                                <br><b>28 декабря 2017г </b>
                            </p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="user_challange_block">
                        <div class="ucb_title">
                            <p>Запуск Кликбаттла
                                <br><b>28 декабря 2017г </b></p>
                        </div>
                    </div>
                    <!-- /block -->
                    <!-- block -->
                    <div class="user_challange_block">
                        <div class="ucb_title">
                            <p>Запуск анимированого тира
                                <br><b>15 января 2018г </b></p>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
</div>