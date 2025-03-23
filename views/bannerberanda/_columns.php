<?php

use kartik\grid\GridView;
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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'keterangan',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'foto',
    // ],
    [
        'attribute' => 'foto',
        'format' => 'html',    
        'value' => function ($data) {
            return Html::img(Yii::getAlias('@web').'/uploads/bannerberanda/'. $data->id . $data->foto,
                ['width' => '200px']);
        },
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'status',
        'value' => function ($data) {
            return ($data['status'] == 1) ? 'Aktif' : 'Tidak Aktif';
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ['1' => 'Aktif', '0' => 'Tidak Aktif'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Status ??'],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'utama',
        'value' => function ($data) {
            return ($data['utama'] == 1) ? 'utama' : 'Tidak';
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ['1' => 'utama', '0' => 'Tidak'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Utama ??'],
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
                $t ='@web/bannerberanda/view?id='.$model->id;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote','data-target'=>'#'.$model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/bannerberanda/update?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target'=>'#'.$model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/bannerberanda/delete?id=' . $model->id;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote', 'data-target'=>'#'.$model->hash, 'title' => 'Delete',
                    'data-confirm' => false, 'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Verifikasi ?',
                    'data-confirm-message' => 'Apa anda yakin menghapus data ini'
                ]);
            },
        ],
    ],

];   
