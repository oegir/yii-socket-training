<?php
namespace app\components;

use yii\helpers\Json;

/**
 *
 * @author oegir
 *        
 */
class ValidateException extends \Exception
{
    public static function fromArray(array $message = null, $code = null, $previous = null)
    {
        if (!is_null($message)) {
            $message = Json::encode($message);
        }
        return  new self($message, $code, $previous);
    }
}

