<?php

use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\widgets\modal\ModalButton;

/* @var $this \humhub\components\View */
/* @var $statusTypes WorkingStatusType[] */
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Working Status</strong> configuration</div>

    <div class="panel-body">
        <div class="clearfix">
            <h4>
                Status Types
                <?= ModalButton::success('Create new type')
                    ->load(['/working-status/config/edit-type'])
                    ->icon('fa-plus')
                    ->right() ?>
            </h4>
            <div class="form-text">
                <?= Yii::t('WorkingStatusModule.config', 'Here you can manage and disable different kind of working status.') ?>
            </div>
        </div>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width:40px;"><?= Yii::t('WorkingStatusModule.base', 'Color') ?></th>
                    <th><?= Yii::t('WorkingStatusModule.base', 'Name') ?></th>
                    <th style="width:100px;"><?= Yii::t('WorkingStatusModule.base', 'Order') ?></th>
                    <th style="width:100px;"><?= Yii::t('WorkingStatusModule.base', 'Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($statusTypes)): ?>
                    <tr>
                        <td colspan="4" class="text-muted text-center">No status types found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($statusTypes as $type): ?>
                        <?= $this->render('_statusTypeItem', ['model' => $type]) ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>