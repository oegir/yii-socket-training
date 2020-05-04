<?php
namespace app\modules\v1\controllers;

use app\models\Sudoku;
use yii\rest\ActiveController;

/**
 *
 * @author oegir
 *        
 */
class SudokuController extends ActiveController
{
    /** @var string строка с указанием класса модели */
    public $modelClass = Sudoku::class;

    /**
     * {@inheritDoc}
     * @see \yii\rest\ActiveController::actions()
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }
}

