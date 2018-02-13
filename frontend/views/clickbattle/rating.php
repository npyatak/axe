<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;
use common\models\ClickbattleResult;
?>
<div class="personal_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <?=$this->render('../profile/_user_header', ['user' => $user]);?>
                <div class="ch_res_content">
                    <div class="main_title">
                        <h2>
                            Уважаемые участники!<br>Конкурс завершен!<br>В ближайшее время будут опубликованы <br>призеры и победители.
                                
                        </h2>
                    </div>
                    
                    <!--<div class="main_title">
                        <h2>
                            <?php if($user && $userResult):?>
                                <b><strong>Рейтинг <br>Клик-баттла</strong><br>У тебя <?=$userResult;?> <?=ClickbattleResult::getScoreText($userResult);?></b>
                                <br><strong><?=$userPlace;?> место</strong>
                                <br>Попробуй сыграть еще раз <br>баллы суммируются по всем твоим играм
                            <?php else:?>
                                <b><strong>Рейтинг Клик</strong>-баттла</b>
                            <?php endif;?>
                        </h2>
                    </div>-->
                    <div class="cmb_buttons">
                        <?php if($user && $user->rules_clickbattle):?>
                    	   <a href="<?=Url::toRoute(['clickbattle/index']);?>" class="scr2_text_btn transition" data-event="clicker_way" data-param="play_again_rating">Играть ещё</a>
                        <?php else:?>
                           <a href="<?=Url::toRoute(['clickbattle/reg']);?>" class="scr2_text_btn transition" data-event="clicker_way" data-param="play_rating">Играть</a>
                        <?php endif;?>
                    	<a href="<?=Url::toRoute(['profile/index']);?>" class="scr2_bottom_button transition" data-event="clicker_way" data-param="lk_rating">Личный кабинет</a>
            		</div>
            		<br/><br/>

                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items} {pager}",
                        'itemOptions' => ['class' => 'ch_res_block'],
                        'itemView' => '_item_rating',
                        'options' => ['class' => 'ch_res_blocks'],
                        'pager' => [
                            'class' => ScrollPager::className(), 
                            'container' => '.ch_res_blocks',
                            'item' => '.ch_res_block',
                            'negativeMargin' => 50,
                            'delay' => 10,
                            'paginationSelector' => '.ch_res_blocks .pagination',
                            'enabledExtensions' => [
                                ScrollPager::EXTENSION_NONE_LEFT,
                            ]
                        ],
                    ]);?>
                </div>
            </div>
        </div>
    </div>
</div>