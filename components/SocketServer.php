<?php
namespace app\components;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use yii\helpers\Json;
use yii\console\Exception;

/**
 *
 * @author oegir
 *        
 */
class SocketServer implements MessageComponentInterface
{
    /**
     * @var \SplObjectStorage
     */
    private $clients;
    
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Ratchet\ComponentInterface::onOpen()
     */
    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Ratchet\MessageInterface::onMessage()
     */
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        $data = Json::decode($msg);
        
        try {
            if (is_null($data) && (! isset($data['command']))) {
                throw new Exception('invalid data received');
            }

            $result = \Yii::$app->runAction($data['command'], $data['data'] ?? []);
            $result = Json::encode($result->toArray());
            
            $this->sendAll($result);
        } catch (Exception $e) {
            $from->close();
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Ratchet\ComponentInterface::onClose()
     */
    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Ratchet\ComponentInterface::onError()
     */
    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $conn->close();
    }

    /**
     * @param string $message
     */
    private function sendAll(string $message): void
    {
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}

