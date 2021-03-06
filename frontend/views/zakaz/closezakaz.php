<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Zakaz;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Закрытые заказы';
?>
 
<div class="zakaz-index">

    <div class="col-xs-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'floatHeader' => true,
            'headerRowOptions' => ['class' => 'headerTable'],
            'pjax' => true,
            'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
            'rowOptions' => function($model, $key, $index, $grid){
                if ($model->srok < date('Y-m-d') && $model->status > Zakaz::STATUS_NEW ) {
                    return ['class' => 'trTable trTablePass italic trSrok'];
                } elseif ($model->srok < date('Y-m-d') && $model->status == Zakaz::STATUS_NEW) {
                    return['class' => 'trTable trTablePass bold trSrok trNew'];
                } elseif ($model->srok > date('Y-m-d') && $model->status == Zakaz::STATUS_NEW){
                    return['class' => 'trTable bold trSrok trNew'];
                } else {
                    return ['class' => 'trTable trNormal'];
                }
            },
            'striped' => false,
            'columns' => [
                [
                    'class'=>'kartik\grid\ExpandRowColumn',
                    'contentOptions' => function($model, $index, $grid){
                        return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                    },
                    'width'=>'10px',
                    'value' => function ($model, $key, $index) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_zakaz', ['model'=> $model]);
                    },
                    'enableRowClick' => true,
                    'expandOneOnly' => true,
                    'expandIcon' => ' ',
                    'collapseIcon' => ' ',
                ],
                [
                    'attribute' => 'id_zakaz',
                    'value' => 'prefics',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr50'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'tr20'],
                    'value' => function($model){
                        if ($model->prioritet == 2) {
                            return '<i class="fa fa-circle fa-red" aria-hidden="true"></i>';
                        } elseif ($model->prioritet == 1) {
                            return '<i class="fa fa-circle fa-ping" aria-hidden="true"></i>';
                        } else {
                            return '';
                        }

                    }
                ],
                [
                    'attribute' => 'srok',
                    'format' => ['datetime', 'php:d M H:i'],
                    'value' => 'srok',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr90'],
                ],
                [
                    'attribute' => 'minut',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr10'],
                ],
                [
                    'attribute' => 'description',
                    'value' => function($model){
                        return StringHelper::truncate($model->description, 100);
                    }
                ],
                [
                    'attribute' => 'id_shipping',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'tr50'],
                    'value' => function($model){
                        if ($model->idShipping->status == 0 or $model->idShipping->status == 1) {
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;" aria-hidden="true"></i>';
                        } elseif ($model->idShipping->status == 2){
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;" aria-hidden="true"></i>';
                        } else{return '';}
                    }
                ],
                [
                    'attribute' => 'oplata',
                    'value' => function($model){
                        return $model->oplata.' р.';
                    },
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr50'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'value' => function($model){
                        return '';
                    },
                    'contentOptions' => ['class' => 'textTr tr20'],
                ],
                [
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::a('Восстановить', ['restore', 'id' => $model->id_zakaz], [
                            'data' => [
                                'confirm' => 'Вы действительно хотите восстановить заказ?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'contentOptions' => ['class' => 'textTr border-right tr90'],
                ],

            ],
        ]); ?>
    </div>
</div>
