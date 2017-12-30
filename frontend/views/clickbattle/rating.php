<?php
use yii\helpers\Url;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;
?>
<div class="personal_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <?=$this->render('../profile/_user_header', ['user' => $user]);?>
                <div class="ch_res_content">
                    <div class="main_title">
                        <h2>
                            <?php if($user && $userResult):?>
                                <b><strong>Рейтинг Клик</strong>-баттла<br>Вы набрали<br> <?=$userResult;?> баллов</b>
                            <?php else:?>
                                <b><strong>Рейтинг Клик</strong>-баттла</b>
                            <?php endif;?>
                        </h2>
                    </div>
                    <div class="cmb_buttons">
                        <?php if($user && $user->rules_clickbattle):?>
                    	   <a href="<?=Url::toRoute(['clickbattle/index']);?>" class="scr2_text_btn transition">Играть ещё</a>
                        <?php else:?>
                           <a href="<?=Url::toRoute(['clickbattle/reg']);?>" class="scr2_text_btn transition">Играть</a>
                        <?php endif;?>
                    	<a href="<?=Url::toRoute(['profile/index']);?>" class="scr2_bottom_button transition">Личный кабинет</a>
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