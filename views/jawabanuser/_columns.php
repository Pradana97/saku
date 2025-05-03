<?php
use yii\helpers\{Url,Html};
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_jawabanuser',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_soal',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_jawaban',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apa_benar',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $t ='@web/jawabanuser/view?id='.$model->id_jawabanuser;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/jawabanuser/update?id=' . $model->id_jawabanuser;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/jawabanuser/delete?id=' . $model->id_jawabanuser;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote', 'data-target'=>'#'.$model->hash, 'title' => 'Delete',
                    'data-confirm' => false, 'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ]);
            },
        ],
    ],

];   
