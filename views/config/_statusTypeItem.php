<?php

use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\widgets\modal\ModalButton;
use yii\helpers\Html;

/* @var $model WorkingStatusType */
?>
<tr>
    <td>
        <i style="display:inline-block;width:20px;height:20px;border-radius:3px;background-color:<?= Html::encode($model->color) ?>"></i>
    </td>
    <td><?= Html::encode($model->name) ?></td>
    <td><?= Html::encode($model->sort_order) ?></td>
    <td>
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
    </td>
</tr>
