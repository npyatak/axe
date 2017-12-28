<div class="user_block_wrapper">
<?php if($user):?>
    <div class="user_block_photo">
        <img src="<?=$user->image;?>" alt="img">
    </div>
    <div class="user_block_info">
        <h4><?=$user->fullName;?></h4>
        <?php if($user->city):?>
            <p><?=$user->city;?> <i class="zmdi zmdi-pin"></i></p>
        <?php endif;?>
    </div>
<?php else:?>
    <div class="user_block_info">
        <span class="profile-social">Войти: </span>
        <?= \frontend\widgets\social\SocialWidget::widget(['action' => 'site/login', 'location' => 'profile']);?>
    </div>
<?php endif;?>
</div>