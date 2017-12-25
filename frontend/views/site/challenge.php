<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<div class="ch_competition_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Голосование</strong> <br> за лучшие игровые моменты </b><br>и участвуйте в розыгрыше Sony Playstation 4 Slim 500 GB  и подарочных наборов AXE</h2>
                </div>
                <div class="ch_cp_sort clearfix">
                    <div class="ch_cp_sort_selects">
                        <a href="#" class="ch_cp_sort_btn active">По дате <span><i class="zmdi zmdi-caret-right-circle"></i></span></a>
                        <a href="#" class="ch_cp_sort_btn">По рейтингу <span><i class="zmdi zmdi-caret-down-circle"></i></span></a>
                    </div>
                    <form class="ch_cp_sort_form">
                        <input type="text" placeholder="поиск по имени">
                        <button><i class="zmdi zmdi-search"></i></button>
                    </form>
                </div>

				<?= ListView::widget([
				    'dataProvider' => $dataProvider,
				    'layout' => '{sorter} {items}',
				    'itemOptions' => ['class' => 'ch_cp_sort_block'],
				    'itemView' => '_item_challenge',
				    'options' => ['class' => 'ch_cp_sort_blocks'],
				    'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
				    'sorter'            => [
					    'attributes'    => [
					        'created_at'    => [
					            'asc'       => ['created_at' => SORT_ASC],
					            'desc'      => ['created_at' => SORT_DESC],
					            'default'   => SORT_DESC,
					            'label'     => 'По дате',
					        ],
					        'likes'    => [
					            'asc'       => ['likes' => SORT_ASC],
					            'desc'      => ['likes' => SORT_DESC],
					            'default'   => SORT_DESC,
					            'label'     => 'По рейтингу',
					        ],
					    ],
					],
				]);?>

                <div class="ch_cp_sort_block_modal" id="ch_cp_modal1">
                    <a href="javascript:void(0)" class="ch_cp_modal_close"><img src="img/close-btn.png" alt="img"></a>
                    <div class="ch_cp_sort_block_modal_img">
                        <img src="img/res2.jpg" alt="img">
                    </div>
                    <div class="ch_modal_footer clearfix">
                        <div class="footer_soc_wrap">
                            <p>Поделитесь и зовите друзей:</p>
                            <ul class="footer_soc">
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-vk"></i></a></li>
                            </ul>
                        </div>
                        <a href="#ch_cp_modal1"><img src="img/like2.png" alt="img"> 78</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>