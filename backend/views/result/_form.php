<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea() ?>

    <?= $form->field($model, 'share_title_fb')->textInput() ?>

    <?= $form->field($model, 'share_title_vk')->textInput() ?>
    
    <?= $form->field($model, 'share_text')->textarea() ?>

    <?= $form->field($model, 'shareVkImageFile')->fileInput() ?>
    
    <?= $form->field($model, 'shareFbImageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
