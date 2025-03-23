<?php

namespace app\controllers;

use app\models\Agenda;
use app\models\Banner;
use app\models\Bannerberanda;
use app\models\Berita;
use app\models\Content;
use app\models\Jadwaldokter;
use app\models\Kerjasama;
use app\models\Layananunggulan;
use app\models\Leafleat;
use app\models\Maklumatpelayanan;
use app\models\Refferensi;
use app\models\Standartpelayanan;
use app\models\Surveykepuasanmasyarakat;
use app\models\Surveyspkspak;
use app\models\Tpreff;
use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\web\Controller;

class WebsiteController extends Controller
{
    public $layout = false; // Tidak menggunakan layout
    
    public function actionIndex()
    {
    //    $bannerberanda = Bannerberanda::find()->where(['status' => 1])->andWhere(['utama' => 0])->all();
    //    $bannerutama = Bannerberanda::find()->where(['status' => 1])->andWhere(['utama' => 1])->one();
      
       //var_dump($berita);die;
        return $this->render('index', [
            //'bannerberanda' => $bannerberanda,
            
        ]);
    }

   
}
