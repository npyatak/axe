<?php 
use yii\helpers\Url;
use yii\helpers\Html;

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
                                <a href="<?=Url::toRoute(['site/restart-test']);?>" class="transition" data-event="test_way" data-param="again">пройти еще раз</a>
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
                                    'data-url' => $share['url'],
                                    'data-title' => $share['title_fb'],
                                    'data-image' => $share['image_fb'],
                                    'data-desc' => $share['text'],
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_fb_lk'
                                ]); ?>
                                <?= Html::a('<i class="zmdi zmdi-vk"></i>', '', [
                                    'class' => 'share',
                                    'data-type' => 'vk',
                                    'data-url' => $share['url'],
                                    'data-title' => $share['title_vk'],
                                    'data-image' => $share['image_vk'],
                                    'data-desc' => $share['text'],
                                    'data-event' => 'test_way',
                                    'data-param' => 'share_vk_lk'
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