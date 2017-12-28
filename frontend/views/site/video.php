<div class="video_news_screen">
    <div class="container">
        <div class="row">
            <div class="main_video_news">
                <div class="main_title">
                    <h2><?=$video['title'];?></h2>
                </div>
                <div class="vb_wrapper">
                    <div class="vp_inner">
                        <iframe src="<?=$video['src'];?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            
            <?php if($otherVideos):?>
            <div class="additional_video">
                <?php foreach ($otherVideos as $key => $v):?>
                    <div class="article_video_block">
                        <a href="<?=$v['src'];?>" class="avb_video video_btn">
                            <img src="<?=$v['img'];?>" alt="img">
                        </a>
                        <div class="av_text">
                            <p><b>Выпуск <?=$key;?></b> <?=$v['title'];?></p>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>