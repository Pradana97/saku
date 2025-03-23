<?php

namespace app\widgets;

use Yii;
use DateTime;
use app\models\{Setting, Attachment};
use yii\db\{Expression, Query};
use yii\web\UploadedFile;
use yii\helpers\{FileHelper, ArrayHelper, Url};
use tpmanc\imagick\Imagick;
use yii\base\Exception;
use yii\log\Logger;

class Wagateway extends \yii\bootstrap\Widget
{
    public function init()
    {
        parent::init();
    }
    //https://wa1.fadesaingrafis.web.id/send-message
    function apiKirimWaRequest(array $params)
    {
        $httpStreamOptions = [
            'method' => $params['method'] ?? 'GET',
            'header' => [
                'Content-Type: application/json',
                // 'Authorization: Bearer ' . ($params['token'] ?? '')
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
        if (!isset($matches[1])) {
            throw new Exception('Can not fetch HTTP response header.');
        }
        $statusCode = (int)$matches[1];
        if ($statusCode >= 200 && $statusCode < 300) {
            return ['body' => $response, 'statusCode' => $statusCode, 'headers' => $http_response_header];
        }
        throw new Exception($response, $statusCode);
    }
    public function apikirimwa($param, $silent = null)
    {
        if (substr($param['nohp'], 0, 1) == '0') {
            $param['nohp'] = substr_replace($param['nohp'], '62', 0, ($param['nohp'][0] == '0'));
        }
        /*
        {
            "api_key": "1234567890",
            "sender": "62888xxxx",
            "number": "62888xxxx",
            "media_type": "image", 	//allow : image,video,audio,pdf,xls,xlsx,doc,docx,zip
            "caption": "Hello World",
            "url": "https://example.com/image.jpg"
          } 

          {
          "api_key": "1234567890",
          "sender": "62888xxxx",
          "number": "62888xxxx",
          "message": "Hello World"
        }
        */
        $link='http://wagateway.rsudibnusinagresik.com/send-message';
        if(isset($param['url'])){
            $t=pathinfo($param['url'])['extension'];
            if($t=='pdf'){
              $message_type='document';
              $captions=['caption'=>$param['url']];
            //   $captions=['caption'=>$param['caption'].'.pdf'];
            }else{
              $message_type='image';
              $captions=['caption'=>$param['caption']];
            }
            $media_type=$message_type;
            $link='http://wagateway.rsudibnusinagresik.com/send-media';
          }
        $payload = [
            // 'api_key' => ArrayHelper::getValue(Yii::$app->params, 'api_key_wa'),
            // 'sender' => ArrayHelper::getValue(Yii::$app->params, 'nohp_sender'),
            $nowasend = Setting::find()->where(['type' => 'nowa'])->one()->value,
            $apiwa = Setting::find()->where(['type' => 'apiwa'])->one()->value,

            'api_key' => $apiwa,
            'sender' => $nowasend,
            'number' => $param['nohp'],
            'message' => $param['pesan'], 
        ];
        if (!empty($captions)) {
            $payload = array_merge($payload, $captions);
        }
        if (!empty($media_type)) {
            $payload = array_merge($payload, $media_type);
        }
        // if (!empty($param['group'])) {
        //     $payload['phone_number'] = $param['group'];
        //     $payload = array_merge($payload, ['is_group_message' => true]);
        // }
        try {
            $reqParams = [
                'url' => $link,
                'method' => 'POST',
                'payload' => json_encode($payload, JSON_UNESCAPED_SLASHES)
            ];
            $response = Yii::$app->tools->apiKirimWaRequest($reqParams);
            if (!empty($silent)) {
                return $response['body'];
            } else {
                echo $response['body'];
            }
        } catch (Exception $e) {
            print_r($e);
        }
    }
}
