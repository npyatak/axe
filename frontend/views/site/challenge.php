<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item-challenge'],
    'itemView' => '_item_challenge',
    'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
    'sorter'            => [
	    'attributes'    => [
	        'created_at'    => [
	            'asc'       => ['created_at' => SORT_ASC],
	            'desc'      => ['created_at' => SORT_DESC],
	            'default'   => SORT_DESC,
	            'label'     => 'По дате',
	        ],
	        'likes'    => [
	            'asc'       => ['likes' => SORT_ASC],
	            'desc'      => ['likes' => SORT_DESC],
	            'default'   => SORT_DESC,
	            'label'     => 'По рейтингу',
	        ],
	    ],
	],
]);?>