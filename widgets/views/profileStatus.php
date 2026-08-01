<?php

use humhub\modules\workingStatus\models\WorkingStatusUser;
use humhub\widgets\bootstrap\Button;
use yii\helpers\Html;

/* @var $this \humhub\components\View */
/* @var $status WorkingStatusUser */
/* @var $isOwnProfile bool */
/* @var $editUrl string */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php if ($isOwnProfile): ?>
            <?= Button::none()
                ->icon('pencil')
                ->sm()
                ->cssClass('float-end')
                ->action('ui.modal.load', $editUrl)
                ->tooltip(Yii::t('WorkingStatusModule.base', 'Change status')) ?>
        <?php endif; ?>
        <strong><?= Yii::t('WorkingStatusModule.base', 'Working Status') ?></strong>
    </div>
    <div class="panel-body">
        <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background-color:<?= Html::encode($status->type->color) ?>;margin-right:6px;"></span>
        <strong><?= Html::encode($status->type->name) ?></strong>
        <?php if (!empty($status->custom_text)): ?>
            <div class="text-muted mt-1"><?= Html::encode($status->custom_text) ?></div>
        <?php endif; ?>
    </div>
</div>
