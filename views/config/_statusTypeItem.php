<?php

use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\widgets\modal\ModalButton;
use yii\helpers\Html;

/* @var $model WorkingStatusType */
?>
<div class="input-group mt-2">
    <span class="input-group-text">
        <i style="display:inline-block;width:16px;height:16px;border-radius:3px;background-color:<?= Html::encode($model->color) ?>"></i>
    </span>
    <span class="input-group-text flex-fill">
        <?= Html::encode($model->name) ?>
    </span>
    <span class="input-group-text">
        <?= ModalButton::primary()
            ->load(['/working-status/config/edit-type', 'id' => $model->id])
            ->icon('fa-pencil')
            ->sm() ?>
        <?= ModalButton::danger()
            ->post(['/working-status/config/delete-type', 'id' => $model->id])
            ->confirm(
                Yii::t('WorkingStatusModule.base', 'Confirm Delete'),
                Yii::t('WorkingStatusModule.base', 'Are you sure you want to delete this status type?'),
                Yii::t('WorkingStatusModule.base', 'Delete'),
            )
            ->icon('fa-times')
            ->sm()
            ->cssClass('ms-2') ?>
    </span>
</div>
