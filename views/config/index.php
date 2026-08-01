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
        <div>
            <?php foreach ($statusTypes as $type): ?>
                <?= $this->render('_statusTypeItem', ['model' => $type]) ?>
            <?php endforeach; ?>
            <?php if (empty($statusTypes)): ?>
                <p class="text-muted">No status types found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>