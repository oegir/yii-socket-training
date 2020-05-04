<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Ratchet\Server\IoServer;
use yii\console\Controller;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use app\components\SocketServer;

class SocketController extends Controller
{
    public function actionStartSocket($port=3000)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer()
                    )
                ),
            $port
            );
        $server->run();
    }
}
