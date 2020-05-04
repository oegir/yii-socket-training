<?php
/* @var yii\web\View $this */
/* @var int $id */

$this->registerJsVar('gameId', $id);
?>
<div class="site-index h100">

    <div class="body-content hauto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <table id="field" class="table table-bordered field">
                        <?php for ($i = 0; $i < 9; $i++): ?>
                            <tr>
                                <?php for ($j = 0; $j < 9; $j++): ?>
                                    <td>
                                        <span></span>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
