<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

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
                    <h2><b><strong>Голосование</strong> <br> за лучшие игровые моменты </b><br>участвуйте в розыгрыше Sony Playstation 4 Slim 500 GB  и подарочных наборов AXE</h2>
                </div>
                <div class="ch_cp_sort clearfix">
                    <div class="ch_cp_sort_selects">
                        <a href="<?=Url::current(['sort' => $sort == '-created_at' ? 'created_at' : '-created_at']);?>" class="ch_cp_sort_btn <?=in_array($sort, ['-created_at', 'created_at']) ? 'active' : '';?>">По дате <span><i class="zmdi zmdi-caret-right-circle"></i></span></a>
                        <a href="<?=Url::current(['sort' => '-likes']);?>" class="ch_cp_sort_btn <?=$sort == '-likes' ? 'active' : '';?>">По рейтингу <span><i class="zmdi zmdi-caret-down-circle"></i></span></a>
                    </div>
                    <div class="ch_cp_sort_form_wrapper">
                        <div class="footer_soc_wrap">
                            <?php if(!$user):?>
                                <p>Голосовать:</p>
                                <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'wrapper' => 'ul', 'wrapperClass' => 'footer_soc']);?>
                            <?php elseif($user && $user->rules_challenge):?>
                                <a href="<?=Url::toRoute(['challenge/index', 'name' => $user->fullName]);?>" class="button-brown">Мои видео</a>
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
				    'layout' => '{items}',
				    'itemOptions' => ['class' => 'ch_cp_sort_block'],
				    'itemView' => '_item',
				    'options' => ['class' => 'ch_cp_sort_blocks'],
				    'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
				]);?>

                <div class="ch_cp_sort_block_modal" id="ch_cp_modal1">
                    <a href="javascript:void(0)" class="ch_cp_modal_close"><img src="/img/close-btn.png" alt="img"></a>
                    <div class="ch_cp_sort_block_modal_img">
                    	<iframe id="challengeVideo" class="video" src="<?=$activeChallenge ? $activeChallenge->videoLink : '';?>" frameborder="0" allowfullscreen></iframe>
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
    	                                    'data-event' => 'test_way',
    	                                    'data-param' => 'share_fb_lk'
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
    	                                    'data-param' => 'share_vk_lk'
    	                                ]); ?>
    	                            </li>
                                </ul>
                            <?php else:?>
                                <p>Войдите, чтобы проголосовать:</p>
                                <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'wrapper' => 'ul', 'wrapperClass' => 'footer_soc']);?>
                            <?php endif;?>
                        </div>

                        <a class="vote-button <?=($activeChallenge && $user && $activeChallenge->userCanVote()) ? '' : 'inactive';?>" data-id="<?=$activeChallenge ? $activeChallenge->id : '';?>" href="#">
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
            alert(url);
    		url += (url.indexOf('?') >= 0 ? '&' : '?') + 'name='+$(this).parent().find('input').val();
    		window.location.href = url;
    	//}
    });
    $('.ch_res_img_link').fancybox({
        showCloseButton: false,
        wrapCSS: 'res_wrap',
        afterShow: function(){
        	$('#challengeVideo').attr('src', this.element.data('link'));
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
        $.fancybox.open('#ch_cp_modal1', {
        showCloseButton: false});
    ";
}

$this->registerJs($script, yii\web\View::POS_END);?>