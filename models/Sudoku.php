<?php

namespace app\models;

use dstotijn\yii2jsv\JsonSchemaValidator;
use Yii;
use yii\helpers\Json;
use app\components\GameSudokuBehavior;
use yii\console\Exception;

/**
 * This is the model class for table "sudoku".
 * @see https://habr.com/ru/post/192102/
 *
 * @property string field
 */
class Sudoku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::init()
     */
    public function init()
    {
        parent::init();
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sudoku';
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::rules()
     */
    public function rules()
    {
        return [
            [
                'field',
                JsonSchemaValidator::className(),
                'schema' => 'file://' . Yii::getAlias('@app/components/SudokuSchema.json')
            ],
            ['field', 'safe'],
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            GameSudokuBehavior::class,
        ];
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::validate()
     */
    public function validate($attributeNames = null, $clearErrors = true)
    {
        if (! parent::validate()) {
            throw new Exception(Json::encode($this->getErrors()));
        }
        return true;
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Arrayable::toArray()
     */
    public function toArray(array $fields = ['id', 'field'], array $expand = [], $recursive = true)
    {
        $result = parent::toArray($fields, $expand, $recursive);
        
        if (isset($result['field'])) {
            $result['field'] = Json::decode($result['field']);
        }
        
        return $result;
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\base\Model::setAttributes()
     */
    public function setAttributes($values, $safeOnly = true)
    {
        parent::setAttributes($values, $safeOnly);
        
        if (is_array($this->field)) {
            $this->field = Json::encode($this->field);
        }
    }
}
