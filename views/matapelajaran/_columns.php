<?php

use app\models\Kelompokkelas;
use app\models\Msmapel;
use yii\helpers\{Url, Html};
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // `[
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'id_mapel',
    // ],`
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_msmapel',
        'value' => 'msmapel.nama',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Msmapel::find()->where(['status' => 1])->all(), 'id_msmapel', 'nama'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
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
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'id_kelompok',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_kelompok',
        'value' => 'kelompok.nama_kelompok',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Kelompokkelas::find()->where(['status' => 1])->all(), 'id_kelompok', 'nama_kelompok'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Pilih..'],
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{view}{update2}',
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a(
                    '<span class="fa fa-users"> Info Guru</span>',
                    $url,
                    ['data-pjax' => 0, 'title' => 'INFO', 'class' => 'btn btn-success btn-xs']
                );
            },

        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'view') {
                return Url::toRoute(['matapelajaran/guru', 'nd' => $model->id_mapel]);
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
                $t = '@web/matapelajaran/view?id=' . $model->id_mapel;
                return Html::a('<span class=""></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'View', 'data-toggle' => 'tooltip']);
            },
            'update' => function ($url, $model) {
                $t = '@web/matapelajaran/update?id=' . $model->id_mapel;
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to($t), ['role' => 'modal-remote', 'data-target' => '#' . $model->hash, 'title' => 'Update', 'data-toggle' => 'tooltip']);
            },
            'delete' => function ($url, $model) {
                $t = '@web/matapelajaran/delete?id=' . $model->id_mapel;
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
