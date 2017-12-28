<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Challenge;

$this->title = 'Челлендж';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'grid-pjax']); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->status === Challenge::STATUS_BANNED) {
                    return ['class' => 'danger'];
                } elseif($model->status === Challenge::STATUS_ACTIVE) {
                    return ['class' => 'success'];
                }
            },
            'columns' => [
                'id',
                'name',
                [
                    'attribute' => 'video',
                    'format' => 'raw',
                    'value' => function($data) {
                        return '<iframe id="challengeVideo" class="video" src="'.$data->videoLink.'" frameborder="0" allowfullscreen></iframe>';
                        //return Html::a($data->videoLink, $data->videoLink);
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function($data) {
                        return $data->statusLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', Challenge::getStatusArray(), ['prompt'=>'']),
                ],
                'likes',
                [
                    'attribute' => 'created_at',
                    'value' => function($data) {
                        return date('d.m.Y H:i', $data->created_at);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{approve} {ban}',
                    'buttons' => [
                        'approve' => function ($url, $model) {
                            $url = Url::toRoute(['/challenge/status', 'id'=>$model->id, 'status' => Challenge::STATUS_ACTIVE]);
                            if($model->status == Challenge::STATUS_ACTIVE) {
                                return '';
                            }
                            return Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', $url, [
                                'class' => 'status-toggle', 
                                'title' => 'Одобрить',
                                'data-pjax' => 0,
                            ]);
                        },
                        'ban' => function ($url, $model) {
                            $url = Url::toRoute(['/challenge/status', 'id'=>$model->id, 'status' => Challenge::STATUS_BANNED]);
                            if($model->status == Challenge::STATUS_BANNED) {
                                return '';
                            }
                            return Html::a('<span class="glyphicon glyphicon-remove-sign"></span>', $url, [
                                'class' => 'status-toggle', 
                                'title' => 'Забанить',
                                'data-pjax' => 0,
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
    
<?php
$script = "
    $(document).on('click', '.status-toggle', function(e) {
        var obj = $(this);

        $.ajax({
            url: obj.attr('href'),
            type: 'POST',
            success: function(result) {
                $.pjax.reload({container:'#grid-pjax'});
            }
        });

        return false;
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>