<div class="test_screen">
    <div class="container">
        <div class="row">
            <div class="frame_block">
                <div class="test_screen_table">
                    <div class="test_screen_cell">
                        <div class="main_title">
                            <h2><b><strong>тест:</strong> <br> "Кем бы ты был в мире киберспорта"</b><br>участвуйте в розыгрыше подарочных наборов Axe  </h2>
                        </div>
                        <div class="test_slider">
							<div>
							    <div class="test_slide">
							        <div class="test_answer">
							        	<p><?=$result->title;?></p>
							        	<p><?=$result->text;?></p>

										<?php if(Yii::$app->user->isGuest) {
                    						echo $this->render('_register');
										} else {
											
										} ?>
							        </div>
							    </div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


