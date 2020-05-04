<?php
/* @var yii\web\View $this */
/* @var yii\data\ActiveDataProvider $provider */

use yii\widgets\ListView;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>
<div class="site-index h100">

    <div class="body-content hauto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <ul>
                        <?= ListView::widget([
                            'dataProvider' => $provider,
                            'itemView' => 'game-list-item',
                            'itemOptions' => ['tag' => false],
                            'options' => ['tag' => false],
                            'summary' => Html::tag('h1', 'Список игр'),
                            'layout' => '{summary}'.PHP_EOL.'{items}'.PHP_EOL,
                            'pager' => [
                                'class' => LinkPager::class,
                                'options' => [
                                    'class' => 'new-task__pagination-list',
                                ],
                                'linkContainerOptions' => [
                                    'class' => 'pagination__item',
                                ],
                                'activePageCssClass' => 'pagination__item--current',
                                'nextPageLabel' => '_',
                                'prevPageLabel' => '_',
                            ],
                        ]); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
