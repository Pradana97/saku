<?php
use yii\helpers\{Url,Html,ArrayHelper};
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use setiam3\ajaxcrud\{CrudAsset,BulkButtonWidget};
$this->title = 'Banner beranda';
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<div class="bannerberanda-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable'.$searchModel->hash,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['bannerberanda/create'],
                    ['role'=>'modal-remote','data-target'=>'#'.$searchModel->hash,'title'=> 'Create new Bannerberandas','class'=>'btn btn-default']).
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
                'heading' => '  ',
                'before'=>'',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-target'=>'#'.$searchModel->hash,
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Verifikasi ?',
                                    'data-confirm-message'=>'Apa anda yakin menghapus data yang di pilih?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>$searchModel->hash,
    "size"=>"modal-mg",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
