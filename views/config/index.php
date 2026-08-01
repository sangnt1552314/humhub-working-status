<?php

use humhub\modules\workingStatus\widgets\ConfigMenu;

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Working Status</strong> configuration</div>

    <?= ConfigMenu::widget() ?>   <!-- renders the tab bar -->

    <div class="panel-body">
        <div class="clearfix">
            <div class="form-text">
                <?= Yii::t('WorkingStatusModule.config', 'Here you can manage and disable different kind of working status.') ?>
            </div>
        </div>
        <br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Color</th>
                    <th>Name</th>
                    <th>Sort Order</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statusTypes as $type): ?>
                    <tr>
                        <td>
                            <span style="display:inline-block; width:20px; height:20px; border-radius:50%; background-color:<?= \yii\helpers\Html::encode($type->color) ?>"></span>
                        </td>
                        <td><?= \yii\helpers\Html::encode($type->name) ?></td>
                        <td><?= \yii\helpers\Html::encode($type->sort_order) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>