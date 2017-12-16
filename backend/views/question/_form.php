<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\TabularInput;
?>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
    	<div class="col-sm-10">
    		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    	</div>
    	<div class="col-sm-2">
    		<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    	</div>
    </div>

    <?= $form->field($model, 'comment')->textarea() ?>

	<hr>

    <h4>Ответы</h4>
	<?= TabularInput::widget([
		'min' => 2,
		'rendererClass' => '\common\components\CustomTableRenderer',
		'removeButtonOptions' => [
			'label' => 'X',
		],
        'addButtonOptions' => [
            'label' => 'Добавить',
            'class' => 'btn btn-primary'
        ],
        'addButtonPosition' => TabularInput::POS_FOOTER,
	    'models' => $answerModels,
	    'columns' => [
	        [
	            'name'  => 'id',
	            'type'  => 'hiddenInput',
	        ],
	        [
	        	'title' => 'Заголовок',
	        	'name' => 'title',
                'enableError' => true
	        ],
	        [
	        	'title' => 'Баллы',
	        	'name' => 'score',
                'enableError' => true
	        ],
	    ],
	]) ?>

	<hr>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
