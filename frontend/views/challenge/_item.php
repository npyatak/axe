<?php
use yii\helpers\Url;
?>

<div class="challenge-item">
	<a href="#ch_cp_modal1" 
		class="ch_cp_sort_block_img ch_res_img_link"
		data-url="<?=Url::current(['id' => $model->id], true);?>" 
		data-link="<?=$model->videoLink;?>" 
		data-id="<?=$model->id;?>"
		data-player="<?=$model->soc ? 'ext' : 'local';?>" 
		data-event="challenge_way" 
		data-param="video_click"
	>
		<img src="<?=$model->image ? $model->image : '/img/file_pic.png';?>" alt="img">
	</a>
	<div class="ch_cp_sort_block_text clearfix">
	    <p><?=$model->name;?></p>
	    <a class="vote-button <?=(!Yii::$app->user->isGuest && $model->userCanVote()) ? '' : 'inactive';?>" data-id="<?=$model->id;?>" href="#" data-event="challenge_way" data-param="like">
	    	<span class="likes-count"><?=$model->likes;?></span>
	    </a>
	</div>
</div>