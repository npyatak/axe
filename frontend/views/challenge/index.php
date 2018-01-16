<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

$share = Yii::$app->params['shareChallenge'];
$share['url'] = Url::current([], true);
$share['image_fb'] = Url::to($share['image_fb'], true);
$share['image_vk'] = Url::to($share['image_vk'], true);

$this->params['share'] = $share;

$this->registerMetaTag(['property' => 'og:description', 'content' => $share['text']], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $share['title_fb']], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $share['image_fb']], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $share['url']], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
?>

<div class="ch_competition_page">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="main_title">
                    <h2><b><strong>Голосуй</strong> <br> за лучший игровой момент </b><br>участвуй в розыгрыше Sony Playstation 4 Slim 500 GB</h2>
                    <p style="color: #ffe;">Один пользователь может проголосовать за любое понравившееся видео один раз в день</p>
                </div>
                <div class="ch_cp_sort clearfix">
                    <div class="ch_cp_sort_selects">
                        <a href="<?=Url::current(['id' => null, 'sort' => $sort == '-created_at' ? 'created_at' : '-created_at']);?>" class="ch_cp_sort_btn <?=in_array($sort, ['-created_at', 'created_at']) ? 'active' : '';?>">По дате <span><i class="zmdi zmdi-caret-right-circle"></i></span></a>
                        <a href="<?=Url::current(['id' => null, 'sort' => '-likes']);?>" class="ch_cp_sort_btn <?=$sort == '-likes' ? 'active' : '';?>">По рейтингу <span><i class="zmdi zmdi-caret-down-circle"></i></span></a>
                    </div>
                    <div class="ch_cp_sort_form_wrapper">
                        <div class="footer_soc_wrap">
                            <?php if(!$user):?>
                                <p>Голосовать:</p>
                                <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'wrapper' => 'ul', 'wrapperClass' => 'footer_soc']);?>
                            <?php elseif($user && $user->rules_challenge):?>
                                <?php if($name == $user->fullName):?>
                                    <a href="<?=Url::toRoute(['challenge/index']);?>" class="button-brown black" data-event="challenge_way" data-param="all_video">Все видео</a>
                                <?php else:?>
                                    <a href="<?=Url::toRoute(['challenge/index', 'name' => $user->fullName]);?>" class="button-brown" data-event="challenge_way" data-param="my_video">Мои видео</a>
                                <?php endif;?>
                            <?php endif;?>
                        </div>
                        <form class="ch_cp_sort_form" novalidate="novalidate">
                            <input type="text" placeholder="поиск по имени" value="<?=$name ? $name : '';?>">
                            <button id="search-name"><i class="zmdi zmdi-search"></i></button>
                        </form>
                    </div>
                </div>

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items} {pager}",
                    'itemOptions' => ['class' => 'ch_cp_sort_block'],
                    'itemView' => '_item',
                    'options' => ['class' => 'ch_cp_sort_blocks'],
                    'pager' => [
                        'class' => ScrollPager::className(), 
                        'container' => '.ch_cp_sort_blocks',
                        'item' => '.ch_cp_sort_block',
                        'negativeMargin' => 100,
                        'delay' => 10,
                        'paginationSelector' => '.ch_cp_sort_blocks .pagination',
                        'enabledExtensions' => [
                            //ScrollPager::EXTENSION_TRIGGER,
                            //ScrollPager::EXTENSION_SPINNER,
                            ScrollPager::EXTENSION_NONE_LEFT,
                            //ScrollPager::EXTENSION_PAGING,
                            //ScrollPager::EXTENSION_HISTORY
                        ]
                    ],
                ]);?>

                <div class="ch_cp_sort_block_modal" id="ch_cp_modal1">
                    <a href="javascript:void(0)" class="ch_cp_modal_close"><img src="/img/close-btn.png" alt="img"></a>
                    <div class="ch_cp_sort_block_modal_img <?=$activeChallenge && !$activeChallenge->soc ? 'localPlayer' : '';?>">
                    	<iframe id="challengeVideo" 
                            class="video"
                            style="<?=$activeChallenge && !$activeChallenge->soc ? 'display: none;' : '';?>" 
                            <?php if($activeChallenge && $activeChallenge->soc) {
                                echo 'src="'.$activeChallenge->videoLink.'"';
                            }?>
                            frameborder="0" allowfullscreen>
                        </iframe>
                        
                        <?= \kato\VideojsWidget::widget([
                            'options' => [
                                'style' => $activeChallenge && !$activeChallenge->soc ? '' : 'display: none;',
                                'controls' => true,
                                //'preload' => 'auto',
                                'id' => 'localPlayer',
                            ],
                            'tags' => [
                                'source' => [
                                    ['src' => $activeChallenge && !$activeChallenge->soc ? $activeChallenge->videoLink : ''],
                                ],
                            ],
                            'multipleResolutions' => false,
                        ]); ?>
                    </div>
                    <div class="ch_modal_footer clearfix">
                        <div class="footer_soc_wrap">
                            <?php if($user):?>
                                <p>Поделитесь и зовите друзей:</p>
                                <ul class="footer_soc">
                                	<li>
    	                                <?= Html::a('<i class="zmdi zmdi-facebook"></i>', '', [
    	                                    'class' => 'share',
    	                                    'data-type' => 'fb',
    	                                    'data-url' => $share['url'],
    	                                    'data-title' => $share['title_fb'],
    	                                    'data-image' => $share['image_fb'],
    	                                    'data-desc' => $share['text'],
    	                                    'data-event' => 'challenge_way',
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
    	                                    'data-event' => 'challenge_way',
    	                                    'data-param' => 'share_vk'
    	                                ]); ?>
    	                            </li>
                                </ul>
                            <?php else:?>
                                <p>Войдите, чтобы проголосовать:</p>
                                <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'wrapper' => 'ul', 'wrapperClass' => 'footer_soc']);?>
                            <?php endif;?>
                        </div>

                        <a class="vote-button <?=($activeChallenge && $user && $activeChallenge->userCanVote()) ? '' : 'inactive';?>" data-id="<?=$activeChallenge ? $activeChallenge->id : '';?>" href="#"  data-event="challenge_way" data-param="like">
                            <span class="likes-count"><?=$activeChallenge ? $activeChallenge->likes : '';?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$script = "
    $('#search-name').on('click', function(e) {
    	e.preventDefault();
    	//if($(this).parent().find('input').val() != '') {
    		//$(this).parent('form').submit();
    		var url = '".Url::current(['name' => null])."';
    		url += (url.indexOf('?') >= 0 ? '&' : '?') + 'name='+$(this).parent().find('input').val();
    		window.location.href = url;
    	//}
    });

    //var player = window.videojs.players.localPlayer

    $('.ch_res_img_link').fancybox({
        showCloseButton: false,
        wrapCSS: 'res_wrap',
        afterShow: function() {
            if(this.element.data('player') == 'ext') {
               $('#localPlayer').hide();
               $('.ch_cp_sort_block_modal_img').removeClass('localPlayer');
        	   $('#challengeVideo').attr('src', this.element.data('link')).show();
            } else {
                $('#challengeVideo').hide();
                $('.ch_cp_sort_block_modal_img').addClass('localPlayer');
                $('#localPlayer').show();
                //player.src(this.element.data('link'));
            }
        	
            $('.ch_modal_footer .vote-button').remove();
        	var newLink = this.element.parent().find('.vote-button').clone();
        	newLink.find('img').attr('src', '/img/like2.png');
        	$('.ch_modal_footer').append(newLink);
	    },
        afterLoad: function() {
            history.pushState(null, null, this.element.data('url'));
            $('.share').attr('data-url', this.element.data('url'));
        },
        beforeClose: function() {
            $('#challengeVideo').attr('src', '');
            //player.src('');
            history.pushState(null, null, '".Url::current(['id' => null])."');
        }
    });

    $('.ch_cp_modal_close').click(function(event) {
        $.fancybox.close();
    });

    $(document).on('click', '.vote-button', function (e) {
    	if($(this).hasClass('inactive')) {
    		return false;
    	}
        var obj = $(this);
        var id = obj.attr('data-id');

        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['challenge/vote'])."',
            data: 'id='+id,
            success: function(data) {
                $('.vote-button[data-id=\''+id+'\']').addClass('inactive').find('span').html(data.likes);
            }
        });

        return false;
    });
    
";

if($activeChallenge) {
    $script .= "
        $('.ch_res_img_link[data-id=\''+$activeChallenge->id+'\']').trigger('click');
    ";
}

$this->registerJs($script, yii\web\View::POS_END);?>