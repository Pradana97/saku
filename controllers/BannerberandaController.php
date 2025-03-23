<?php
namespace app\controllers;
use Yii;
use app\models\Bannerberanda;
use app\models\BannerberandaSearch;
use yii\web\{Controller,Response,NotFoundHttpException};
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\{Html,Url,ArrayHelper};
class BannerberandaController extends Controller
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
        $searchModel = new BannerberandaSearch();
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
                    'title'=> "Bannerberanda #".$id,
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
        $model = new Bannerberanda();
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Banner Baru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){
                $image = UploadedFile::getInstance($model, 'foto');
                if (!empty($image)) {
                    $model->foto = $image;
                    $model->save(false);
                    $image->saveAs(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $image->name);
                }
                else{
                    Yii::$app->session->setFlash('warning', "file belum di lengkapi, mohon untuk melengkapinya");
                }
                $model->save();
                return [
                    'forceReload' => '#crud-datatable'.$model->hash.'-pjax',
                    'title'=> "Tambah Banner Baru",
                    'content'=>'<span class="text-success">Create Bannerberanda success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.$model->hash])
        
                ];         
            }else{           
                return [
                    'title'=> "Tambah Banner Baru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            if ($model->load($request->post())) {
                $image = UploadedFile::getInstance($model, 'foto');
                if (!empty($image)) {
                    $model->foto = $image;
                    $model->save(false);
                    $image->saveAs(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $image->name);
                }
                else{
                    Yii::$app->session->setFlash('warning', "file belum di lengkapi, mohon untuk melengkapinya");
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
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
        $oldfile = $model->foto;    
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Bannerberanda #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                $image = UploadedFile::getInstance($model, 'foto');
                if (!empty($image)) {
                    unlink(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $oldfile);
                    $model->foto = $image;
                    $model->save(false);
                    $image->saveAs(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $image->name);
                }else{
                    $model->foto = $oldfile;
                    $model->save(false);
                }
                return [
                    'forceReload' => '#crud-datatable'.$model->hash.'-pjax',
                    'title'=> "Bannerberanda #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote','data-target'=>'#'.$model->hash])
                ];    
            }else{
                 return [
                    'title'=> "Update Bannerberanda #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            if ($model->load($request->post())) {
                $image = UploadedFile::getInstance($model, 'foto');
                if(!empty($image)) {
                    unlink(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $oldfile);
                    $model->foto = $image;
                    $model->save(false);
                    $image->saveAs(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $image->name);
                }else{
                    $model->foto = $oldfile;
                    $model->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    public function actionDelete($id){
        $request = Yii::$app->request;
        $model=$this->findModel($id);
        $oldfile = $model->foto;   
        unlink(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $oldfile);
        $model->delete();
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
            $oldfile = $model->foto;  
            unlink(Yii::$app->basePath . '/web/uploads/bannerberanda/' . $model->id . $oldfile);
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
        if (($model = Bannerberanda::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
