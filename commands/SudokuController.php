<?php

namespace app\commands;

use app\models\Sudoku;
use yii\base\Arrayable;
use yii\console\Controller;
use yii\web\NotFoundHttpException;

/**
 * SudokuController implements actions for Sudoku model.
 */
class SudokuController extends Controller
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $field;
    
    /**
     * {@inheritDoc}
     * @see \yii\console\Controller::options()
     */
    public function options($actionID)
    {
        $options = [
            'update' => ['id', 'field'],
            'view' => ['id'],
        ];
        return $options[$actionID] ?? [];
    }
    
    public function actionsIndex(): Arrayable
    {
        
    }
    
    /**
     * Displays a single Sudoku model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(): Arrayable
    {
        return $this->findModel($this->id);
    }

    /**
     * Creates a new Sudoku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(): Arrayable
    {
        $model = new Sudoku();
        $model->save();
        
        return $model;
    }

    /**
     * Updates an existing Sudoku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel($this->id);
        
        $model->setAttributes(['field' => $this->field]);
        $model->save();

        return $model;
    }

    /**
     * Finds the Sudoku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sudoku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sudoku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
