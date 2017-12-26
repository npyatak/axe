<a href="#ch_cp_modal1" class="ch_cp_sort_block_img ch_res_img_link" data-link="<?=$model->videoLink;?>" data-id="<?=$model->id;?>">
	<img src="<?=$model->image;?>" alt="img">
</a>
<div class="ch_cp_sort_block_text clearfix">
    <p><?=$model->name;?></p>
    <?php if(Yii::$app->user->isGuest):?>

    <?php else:?>
    <a class="vote-button <?=$model->userCanVote() ? '' : 'inactive';?>" data-id="<?=$model->id;?>" href="#">
    	<img src="/img/like.png" alt="img"> 
    	<span class="likes-count"><?=$model->likes;?></span>
    </a>
    <?php endif;?>
</div>