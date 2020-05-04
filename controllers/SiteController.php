<?php

namespace app\controllers;

use app\models\Sudoku;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Sudoku::find()->where(['<>', 'finish', 1])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);
        
        return $this->render('index', [
            'provider' => $provider,
        ]);
    }
    
    /**
     * @param int $id
     * @return string
     */
    public function actionGame($id = null)
    {
        return $this->render('game', [
            'id' => $id
        ]);
    }
}
