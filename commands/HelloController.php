<?php
namespace app\commands;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\Transaksi;
use tebazil\yii2seeder\Seeder;
use Yii;
class HelloController extends Controller
{
    public function actionTx(){
        $app=Transaksi::getDashboard(1201);
        echo json_encode($app);die;
    }
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
        return ExitCode::OK;
    }
    public function actionSeed(){
        $seeder = new \tebazil\yii2seeder\Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();
        $seeder->table('goods_copy')->columns([
            'id', //automatic pk
            'type'=>1261,
            'desc'=>$faker->firstName,
            'status'=>33,
            'owner'=>36,
            'own_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
            'kalibrasi'=>1,
            'tgl_kalibrasi'=>$faker->date($format = 'Y-m-d', $max = 'now')
        ])->rowQuantity(1000);
        $seeder->refill();
    }
    public function actionTesx(){
        // return Yii::$app->tools->runcmd();
        // return Yii::$app->tools->runcmd($params='dbserver');
    }
    public function sendwa_old($param){
        $start_time = microtime(true);
        echo $message = ' runing  ...'."\n";
            Yii::$app->tools->apikirimwa($param, 'silent');
        echo $message = 'sukses runing'."\n";
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time)/60;
        echo $execution_time."\n";
        return ExitCode::OK;
    }
    public function actionSendwa($param){
        //  $param=[
        //      'nohp'=>"085161591314",
        //      'pesan'=>"https://ti.handayani.ac.id/wp-content/uploads/2020/07/RPS-PEMROGRAMAN-VISUAL-III.pdf"
        //  ];
        $param=json_decode($param,true);
        $start_time = microtime(true);
        echo $message = ' runing  ...'."\n";
            Yii::$app->wagateway->apikirimwa($param, 'silent');
        echo $message = 'sukses runing'."\n";
        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time)/60;
        echo $execution_time."\n";
        return ExitCode::OK;
    }
}
