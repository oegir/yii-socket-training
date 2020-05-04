<?php
namespace app\components;

use yii\base\Behavior;
use yii\helpers\Json;
use yii\db\ActiveRecord;

/**
 *
 * @author oegir
 *        
 */
class GameSudokuBehavior extends Behavior
{
    /**
     * {@inheritDoc}
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_INIT => 'initField',
        ];
    }
    
    /**
     * Initialize Sudoku playground
     */
    public function initField(): void
    {
        if (empty($this->field)) {
            $this->fillField();
            $this->transpose();
        }
    }
    
    /**
     * Initial fild filling
     */
    private function fillField(): void
    {
        $field = [];
        
        for ($row = 0; $row < 9; $row ++) {
            $currentRow = [];
            $sign = floor($row / 3) + (($row * 3) % 9 + 1);
            
            for ($col = 0; $col < 9; $col ++) {
                $currentRow[] = $sign ++;
                
                if ($sign > 9) {
                    $sign = 1;
                }
            }
            $field[] = $currentRow;
        }
        
        $this->owner->setAttribute('field', Json::encode($field));
    }
    
    /**
     * Field transpose
     */
    private function transpose(): void
    {
        $original = Json::decode($this->owner->field);
        $transposed = [];
        
        for ($i = 0; $i < 9; $i++) {
            $transposed[] = array_column($original, $i);
        }
        
        $this->owner->setAttribute('field', Json::encode($transposed));
    }
}

