<?php
namespace app\widgets;
use Yii;
use DateTime;
use app\models\{Setting,Attachment};
use yii\db\{Expression,Query};
use yii\web\UploadedFile;
use yii\helpers\{FileHelper,ArrayHelper,Url};
use tpmanc\imagick\Imagick;
use yii\base\Exception;
use yii\log\Logger;

class Tools extends \yii\bootstrap\Widget
{
  public function init(){
    parent::init();
  }
  public function isAdmin(){
    $role = $this->getcurrentroleuser();
    return (ArrayHelper::keyExists('admin', $role))?true:false;
  }

  public function upload($instancename, $path){
    $file = UploadedFile::getInstanceByName($instancename);
    $ext = substr($file->name, strrpos($file->name, '.') + 1);
    $path .= '_' . time();
    $exploded = explode('/', $path);
    $dir = trim($path, end($exploded));
    if (!file_exists($dir) && !is_dir($dir)) {
      FileHelper::createDirectory($dir, $mode = 0775, $recursive = true);
    }
    $file->saveAs($path . '.' . $ext);
    $explodeNamafile = explode('/', $path);
    $namafile = end($explodeNamafile) . '.' . $ext;
    return $namafile;
  }
  public function uploadmulti($files,$path,$models){
    if(!empty($models->id))
      foreach ($files as $file) {
        $ext = substr($file->name, strrpos($file->name, '.') + 1);
        $uid=uniqid();
        $bpath=$path.$models->id.'_'.$uid.'.'.$ext;
        if($bpath){//sukses save
          $att=new Attachment();
          $att->transaksi_id=$models->id;
          $data = file_get_contents($file->tempName);
          $base64 = 'data:'.$file->type.';base64,'.base64_encode($data);
          $att->blob=$base64;
          $att->save(false);
        }
      }
  }

  public function pdftoimg($pathfile){
    $preview = '';
    $ext = pathinfo($pathfile);
    $image = ['jpg', 'jpeg', 'png'];
    if ($ext['extension'] == 'pdf') {
      $this->genPdfThumbnail($pathfile, $ext['basename'] . '.jpeg');
      $preview = \Yii::getAlias('@web/uploads/foto/510204244/') . $ext['basename'] . '.jpeg';
    } elseif (in_array(strtolower($ext['extension']), $image)) {
    } else {
      $preview = '';
    }
    return $preview;
  }

  public function genPdfThumbnail($source, $target){
    $target = dirname($source) . DIRECTORY_SEPARATOR . $target;
    $im     = new Imagick($source); // 0-first page, 1-second page
    $im->setImageColorspace(255); // prevent image colors from inverting
    $im->setimageformat("jpeg");
    $im->thumbnailimage(160, 160); // width and height
    $im->writeimage($target);
    $im->clear();
    $im->destroy();
  }

  public function getWorkingDays($startDate,$endDate,$holidays){
    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);
    $days = ($endDate - $startDate) / 86400 + 1;
    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);
    if ($the_first_day_of_week <= $the_last_day_of_week) {
        //if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    }else {
        if ($the_first_day_of_week == 7) {
            $no_remaining_days--;
            // if ($the_last_day_of_week == 6) {
            //     // if the end date is a Saturday, then we subtract another day
            //     $no_remaining_days--;
            // }
        }else {
            $no_remaining_days -= 1;
        }
    }
   $workingDays = $no_full_weeks * 6;//6hari kerja
    if ($no_remaining_days > 0 ){
      $workingDays += $no_remaining_days;
    }
    foreach($holidays as $holiday){
        $time_stamp=strtotime($holiday);
        if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 7 && date("N",$time_stamp) != 7)
            $workingDays--;
    }
    return $workingDays;
  }

  public function getUsia($date){
    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime();
    $diff = $datetime1->diff($datetime2);
    return $diff->y . " tahun " . $diff->m . " bulan " . $diff->d . " hari";
  }

  public function listIcon($typeicons){
    $icon = [];
    if ($typeicons == 'glyphicon') {
      $path = \Yii::getAlias('@vendor/bower-asset/bootstrap/docs/_data/glyphicons.yml');
      $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));
      foreach ($array as $k => $value) {
        $icon[] = ['key' => $k, 'value' => $typeicons . ' ' . $value];
      }
    } else {
      $path = \Yii::getAlias('@webroot/css/icons.yml');
      $array = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($path));

      foreach ($array as $k => $value) {
        $icon[] = ['key' => $k, 'value' => $typeicons . $k];
      }
    }
    return $icon;
  }

  public function getcurrentroleuser(){
    $currentrole = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
    foreach ($currentrole as $roles) {
      $role[] = ['name' => $roles->name];
    }
    return ArrayHelper::map($role, 'name', 'name');
  }

  public function findModelAll($condition, $models){
    $modelx = \Yii::createObject([
      'class' => "app\models\\" . $models,
    ]);
    if (($model = $modelx::findAll($condition)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function controllernamebyreferer(){
    $referrerUrl = trim(\Yii::$app->request->referrer, '/');
    $urlParts = parse_url($referrerUrl);
    $a=explode(Url::to('@web'),$urlParts['path']);
    $a2='';
    foreach($a as $a2){$a2;}
    $controller_name = explode('/', $a2);
    return $controller_name[1];
  }

  public function http_request($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }

  public function sendWa($no_wa,$message){
    //transform nohp format wa diawali 62
    if(substr($no_wa,0,1)=='0'){
      $no_wa=substr_replace($no_wa, '62', 0, ($no_wa[0] == '0'));
    }
    $serverwa=Setting::find()->where(['param'=>'wagateway','data'=>'serverwa','status'=>1])->one()->value;
    $tokenwa=Setting::find()->where(['param'=>'wagateway','data'=>'tokenwa','status'=>1])->one()->value;
    $url=$serverwa.'?token='.$tokenwa.'&no='.$no_wa.'&text='.$message;
    // $url='http://'.ArrayHelper::getValue(Yii::$app->params,'serverwa').'?token='.ArrayHelper::getValue(Yii::$app->params,'tokenwa').'&no='.$no_wa.'&text='.$message;
    $this->http_request($url);
  }
  public function columnify($leftCol, $rightCol, $leftWidth, $rightWidth, $space = 4){
      $leftWrapped = wordwrap($leftCol, $leftWidth, "\n", true);
      $rightWrapped = wordwrap($rightCol, $rightWidth, "\n", true);

      $leftLines = explode("\n", $leftWrapped);
      $rightLines = explode("\n", $rightWrapped);
      $allLines = array();
      for ($i = 0; $i < max(count($leftLines), count($rightLines)); $i ++) {
          $leftPart = str_pad(isset($leftLines[$i]) ? $leftLines[$i] : "", $leftWidth, " ");
          $rightPart = str_pad(isset($rightLines[$i]) ? $rightLines[$i] : "", $rightWidth, " ");
          $allLines[] = $leftPart . str_repeat(" ", $space) . $rightPart;
      }
	    $aln=implode("\n",$allLines);
      return $aln. "\n";
  }
  public function asCurrency($val){
    return ($val>0)?'Rp. '.Yii::$app->formatter->asInteger(round($val)):'';
  }
  function apiKirimWaRequest(array $params) {
    $httpStreamOptions = [
      'method' => $params['method'] ?? 'GET',
      'header' => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($params['token'] ?? '')
      ],
      'timeout' => 15,
      'ignore_errors' => true
    ];
    if ($httpStreamOptions['method'] === 'POST') {
      $httpStreamOptions['header'][] = sprintf('Content-Length: %d', strlen($params['payload'] ?? ''));
      $httpStreamOptions['content'] = $params['payload'];
    }
    $httpStreamOptions['header'] = implode("\r\n", $httpStreamOptions['header']) . "\r\n";
    $stream = stream_context_create(['http' => $httpStreamOptions]);
    $response = file_get_contents($params['url'], false, $stream);
    $httpStatus = $http_response_header[0];
    preg_match('#HTTP/[\d\.]+\s(\d{3})#i', $httpStatus, $matches);
    if (! isset($matches[1])) {
      throw new Exception('Can not fetch HTTP response header.');
    }
    $statusCode = (int)$matches[1];
    if ($statusCode >= 200 && $statusCode < 300) {
      return ['body' => $response, 'statusCode' => $statusCode, 'headers' => $http_response_header];
    }
    throw new Exception($response, $statusCode);
  }
  public function apikirimwa($param,$silent=null){
    if(substr($param['nohp'],0,1)=='0'){
      $param['nohp']=substr_replace($param['nohp'], '62', 0, ($param['nohp'][0] == '0'));
    }
    $message=isset($param['url'])?$param['url']:$param['pesan'];
    $captions=[];
    if(isset($param['url'])){
      $t=pathinfo($param['url'])['extension'];
      if($t=='pdf'){
        $message_type='document';
        $captions=['caption'=>$param['caption'].'.pdf'];
      }else{
        $message_type='image';
        $captions=['caption'=>$param['caption']];
      }
    }else{
      $message_type='text';
    }
    $payload=[
      'message' => $message,
      'phone_number' => $param['nohp'],
      'message_type' => $message_type,
      'device_id' => ArrayHelper::getValue(Yii::$app->params, 'devices'),
    ];
    if(!empty($captions)){
      $payload=array_merge($payload,$captions);
    }
    if(!empty($param['group'])){
      $payload['phone_number']=$param['group'];
      $payload=array_merge($payload,['is_group_message' => true]);
    }
    try {
        $reqParams = [
        'token' => ArrayHelper::getValue(Yii::$app->params, 'tokenkirimwa'),
          'url' => 'https://api.kirimwa.id/v1/messages',
          'method' => 'POST',
          'payload' =>json_encode($payload,JSON_UNESCAPED_SLASHES)
        ];
        $response = Yii::$app->tools->apiKirimWaRequest($reqParams);
        if(!empty($silent)){
          return $response['body'];
        }else{
          echo $response['body'];
        }
      } catch (Exception $e) {
        print_r($e);
      }
  }
  public function runcmd($params=null){
    $cmd=$params?
          ArrayHelper::getValue(Yii::$app->params,$params):
          ArrayHelper::getValue(Yii::$app->params,'whoami');
    // echo $cmd;
    $output=null;
    $retval=null;
    exec($cmd, $output, $retval);
    $out= json_encode($output,JSON_UNESCAPED_SLASHES);
    // echo $out;
    // $des=json_decode($out);
    // echo $des[0];
    \Yii::info("$out", 'cmd');
    return $out;
  }
  public function weekOfMonth($date) {
    $firstOfMonth = date("Y-m-01", strtotime($date));
    return (intval(date("W", strtotime($date))) - intval(date("W", strtotime($firstOfMonth))))+1; //+1 start from 0
  }
}
