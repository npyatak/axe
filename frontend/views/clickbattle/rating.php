<?php
use yii\helpers\Url;
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
                                    <b><strong>Рейтинг Клик</strong>-баттла<br>Вы набрали<br> XXXX баллов</b>
                                <?php else:?>
                                    <b><strong>Рейтинг Клик</strong>-баттла</b>
                                <?php endif;?>
                            </h2>
                        </div>
                        <div class="cmb_buttons">
                        	<a href="<?=Url::toRoute(['clickbattle/reg']);?>" class="scr2_text_btn transition"><?=$user && $user->rules_clickbattle ? 'Играть ещё' : 'Играть';?></a>
                        	<a href="<?=Url::toRoute(['profile/index']);?>" class="scr2_bottom_button transition">Личный кабинет</a>
                		</div>
                		<br/><br/>
                        <div class="ch_res_blocks">
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                            <!-- block -->
                            <div class="ch_res_block">
                                <div class="ch_res_block_img">
                                    <img src="img/vinner.jpg" alt="img">
                                </div>
                                <div class="user_block_info">
                                    <h4>viktor tsoy</h4>
                                    <p>Moscow <i class="zmdi zmdi-pin"></i></p>
                                    <h5>5689 баллов</h5>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <!-- /blocks -->
                        <!-- res_pagi -->
                        <div class="res_pagi_wrapper">
                            <ul class="res_pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                            </ul>
                        </div>
                        <!-- /res_pagi -->
                    </div>
                </div>
            </div>
        </div>
    </div>