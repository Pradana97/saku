<?php

use yii\helpers\{Url, Html};

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
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'id_kelompok',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama_kelompok',
    ],
    [
        'class' => '\kartik\grid\BooleanColumn',
        'attribute' => 'status',
        'trueLabel' => 'Aktif',
        'falseLabel' => 'Nonaktif',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'catatan',
    ],


    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view}{update2}',
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a(
                    '<span class="fa fa-users"> Info Group</span>',
                    $url,
                    ['data-pjax' => 0, 'title' => 'INFO', 'class' => 'btn btn-success btn-xs']
                );
            },
          
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                return Url::toRoute(['kelompokkelas/group', 'nd' => $model->id_kelompok]);
            }
           
        },
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                $t = '@web/kelompokkelas/view?id=' . $model->id_kelompok;
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/kelompokkelas/update?id=' . $model->id_kelompok;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/kelompokkelas/delete?id=' . $model->id_kelompok;
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to($t), [
                    'role' => 'modal-remote',
                    'data-target' => '#' . $model->hash,
                    'title' => 'Delete',
                    'data-confirm' => false,
                    'data-method' => false,
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Are you sure?',
                    'data-confirm-message' => 'Are you sure want to delete this item'
                ]);
            },
        ],
    ],

];
