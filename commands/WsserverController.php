<?php
namespace app\commands;
use consik\yii2websocket\events\WSClientEvent;
use yii\console\Controller;
use consik\yii2websocket\events\WSClientMessageEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
/*
 *
 * Starting yii2 console application as daemon using nohup
 * nohup php yii _ControllerName_/_ActionName_ &
 *
 * */
class WsserverController extends Controller
{
    public function actionStart($port = null)
    {
        $server = new EchoServer();
        if ($port) {
            $server->port = $port;
        }
        $server->on(WebSocketServer::EVENT_WEBSOCKET_OPEN, function($e) use($server) {
            echo "Server started at port " . $server->port;
        });
        $server->on(WebSocketServer::EVENT_CLIENT_MESSAGE, function($e) use($server) {
            // echo PHP_EOL;    echo PHP_EOL;
            // echo json_encode($e);
            // echo json_encode($e->cleint->name);
            // foreach ($e->clients as $client) {
            //     print_r($client);
            //     // echo "New client message " . $e->message;
            //     $e->client->send($e->message);
            //     // $e->client->send(json_encode($e->message));
            // }
        });
        $server->start();
    }
}

class EchoServer extends WebSocketServer
{
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_CLIENT_MESSAGE, function (WSClientMessageEvent $e) {
            $e->client->send($e->message);
        });
        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;
        });
    }
    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }
    public function commandNeworder(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];
        if (!$client->name) {
            $result['message'] = 'Set your name';
        } elseif (!empty($request['message']) && $message = trim($request['message']) ) {
            foreach ($this->clients as $chatClient) {
                $chatClient->send( json_encode([
                    'type' => 'chat',
                    'from' => $client->name,
                    'message' => $message
                ],JSON_UNESCAPED_SLASHES ));
            }
        } else {
            $result['message'] = 'Enter message';
        }
        $client->send( json_encode($result,JSON_UNESCAPED_SLASHES) );
    }
    public function commandChat(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];
        if (!$client->name) {
            $result['message'] = 'Set your name';
        } elseif (!empty($request['message']) && $message = trim($request['message']) ) {
            foreach ($this->clients as $chatClient) {
                $chatClient->send( json_encode([
                    'type' => 'chat',
                    'from' => $client->name,
                    'message' => $message
                ],JSON_UNESCAPED_SLASHES ));
            }
        } else {
            $result['message'] = 'Enter message';
        }
        $client->send( json_encode($result,JSON_UNESCAPED_SLASHES) );
    }
    public function commandSetName(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Username updated'];
        if (!empty($request['name']) && $name = trim($request['name'])) {
            $usernameFree = true;
            foreach ($this->clients as $chatClient) {
                if ($chatClient != $client && $chatClient->name == $name) {
                    $result['message'] = 'This name is used by other user';
                    $usernameFree = false;
                    break;
                }
            }
            if ($usernameFree) {
                $client->name = $name;
            }
        } else {
            $result['message'] = 'Invalid username';
        }
        $client->send(json_encode($result,JSON_UNESCAPED_SLASHES) );
    }
    function commandPing(ConnectionInterface $client, $msg)
    {
        $client->send('Pong');
    }
}