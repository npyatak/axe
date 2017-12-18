<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Результаты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить результат', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                [
                    'attribute' => 'share_vk_image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->shareVkImageUrl, ['width' => '150px']);
                    }
                ],
                [
                    'attribute' => 'share_fb_image',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->shareFbImageUrl, ['width' => '150px']);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
