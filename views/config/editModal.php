<?php

use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\widgets\modal\Modal;
use humhub\widgets\modal\ModalButton;

/* @var $model WorkingStatusType */

$title = $model->isNewRecord
    ? Yii::t('WorkingStatusModule.base', '<strong>Create</strong> new status type')
    : Yii::t('WorkingStatusModule.base', '<strong>Edit</strong> status type');
?>

<?php $form = Modal::beginFormDialog([
    'title' => $title,
    'footer' => ModalButton::cancel() . ModalButton::save()->submit(),
]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100, 'autofocus' => '']) ?>
    <?= $form->field($model, 'color')->colorInput() ?>
    <?= $form->field($model, 'sort_order')->input('number', ['min' => 0]) ?>

<?php Modal::endFormDialog() ?>
