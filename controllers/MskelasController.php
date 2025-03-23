<?php
namespace app\controllers;
use Yii;
use app\models\MsKelas;
use app\models\MskelasSearch;
use yii\web\{Controller,Response,NotFoundHttpException};
use yii\filters\VerbFilter;
use yii\helpers\{Html,Url,ArrayHelper};
class MskelasController extends Controller
{
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }
    public function actionIndex(){    
        $searchModel = new MskelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id){   
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "MsKelas #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.$model->hash])
                ];    
        }else{
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreate(){
        $request = Yii::$app->request;
        $model = new MsKelas();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new MsKelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload' => '#crud-datatable'.$model->hash.'-pjax',
                    'title'=> "Create new MsKelas",
                    'content'=>'<span class="text-success">Create MsKelas success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.$model->hash])
        
                ];         
            }else{           
                return [
                    'title'=> "Create new MsKelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_kelas]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }
    public function actionUpdate($id){
        $request = Yii::$app->request;
        $model = $this->findModel($id);       
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update MsKelas #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload' => '#crud-datatable'.$model->hash.'-pjax',
                    'title'=> "MsKelas #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.$model->hash])
                ];    
            }else{
                 return [
                    'title'=> "Update MsKelas #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id_kelas]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionDelete($id){
        $request = Yii::$app->request;
        $model=$this->findModel($id);$model->delete();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload' => '#crud-datatable' . $model->hash . '-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }
     
    public function actionBulkdelete(){        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload' => '#crud-datatable' . $model->hash . '-pjax'];
        }else{
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = MsKelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
