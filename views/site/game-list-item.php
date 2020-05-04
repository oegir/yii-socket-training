<?php
/* @var yii\web\View $this */
/* @var app\models\Sudoku $model */

use yii\helpers\Url;

?>

<li>
    <a href="<?= Url::to("game/$model->id") ?>">Game - <?= $model->id ?></a>
</li>