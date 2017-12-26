<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$share = Yii::$app->params['share'];
$share['url'] = Url::canonical();
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
                    <h2><b><strong>Голосование</strong> <br> за лучшие игровые моменты </b><br>и участвуйте в розыгрыше Sony Playstation 4 Slim 500 GB  и подарочных наборов AXE</h2>
                </div>
                <div class="ch_cp_sort clearfix">
                    <div class="ch_cp_sort_selects">
                        <a href="<?=Url::current(['sort' => 'created_at']);?>" class="ch_cp_sort_btn <?=$sort == 'created_at' ? 'active' : '';?>">По дате <span><i class="zmdi zmdi-caret-right-circle"></i></span></a>
                        <a href="<?=Url::current(['sort' => '-likes']);?>" class="ch_cp_sort_btn <?=$sort == '-likes' ? 'active' : '';?>">По рейтингу <span><i class="zmdi zmdi-caret-down-circle"></i></span></a>
                    </div>
                    <form class="ch_cp_sort_form">
                        <input type="text" placeholder="поиск по имени" value="<?=$name;?>">
                        <button id="search-name"><i class="zmdi zmdi-search"></i></button>
                    </form>
                </div>

				<?= ListView::widget([
				    'dataProvider' => $dataProvider,
				    'layout' => '{items}',
				    'itemOptions' => ['class' => 'ch_cp_sort_block'],
				    'itemView' => '_item_challenge',
				    'options' => ['class' => 'ch_cp_sort_blocks'],
				    'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
				]);?>

                <div class="ch_cp_sort_block_modal" id="ch_cp_modal1">
                    <a href="javascript:void(0)" class="ch_cp_modal_close"><img src="/img/close-btn.png" alt="img"></a>
                    <div class="ch_cp_sort_block_modal_img">
                    	<iframe id="challengeVideo" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="ch_modal_footer clearfix">
                        <div class="footer_soc_wrap">
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
                        </div>
                        <a href="#" class="vote-button">
                        	<img src="/img/like2.png" alt="img"> <span class="likes-count"></span>
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
    })

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
            url: '/site/challenge-vote',
            data: 'id='+id,
            success: function(data) {
            	console.log(data.likes);
                $('.vote-button[data-id=\''+id+'\']').addClass('inactive').find('span').html(data.likes);
            }
        });

        return false;
    });
    
";

$this->registerJs($script, yii\web\View::POS_END);?>