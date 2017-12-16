<?php 
use yii\helpers\Html;
?>

<div>
    <div class="test_slide">
        <h3><?=$question->title;?></h3>
        <div class="test_checks">
			<?=Html::hiddenInput('question', $question->id);?>
        	<?php foreach ($question->answers as $answer):?>
                <div class="test_check">
                    <input type="radio" name="answer" value="<?=$answer->id;?>" id="a<?=$answer->id;?>">
                    <label for="a<?=$answer->id;?>"><?=$answer->title;?></label>
                </div>
			<?php endforeach;?>
        </div>
        <div class="test_buttons">
            <a href="" class="next_question_btn test_button transition inactive">Следующий вопрос</a>
        </div>
    </div>
</div>