<?php
use yii\helpers\{Url,Html,ArrayHelper};
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use setiam3\ajaxcrud\{CrudAsset,BulkButtonWidget};
$this->title = 'MasterJabatan';
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<div class="ms-jabatan-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable'.$searchModel->hash,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['msjabatan/create'],
                    ['role'=>'modal-remote','data-target'=>'#'.$searchModel->hash,'title'=> 'Create new Ms Jabatans','class'=>'btn btn-default']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '',
                'before'=>'',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>$searchModel->hash,
    "size"=>"modal-md",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
