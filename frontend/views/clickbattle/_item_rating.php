
<div class="ch_res_block_img">
    <img src="<?=$model->user->image;?>" alt="img">
</div>
<div class="user_block_info">
    <h4><?=$model->user->fullName;?></h4>
    <?php if($model->user->city):?>
        <p><?=$model->user->city;?> <i class="zmdi zmdi-pin"></i></p>
    <?php endif;?>
    <h5><?=$model->maxScore;?> баллов</h5>
</div>