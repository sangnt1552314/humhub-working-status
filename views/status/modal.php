<?php

use humhub\modules\workingStatus\models\WorkingStatusUser;
use humhub\widgets\modal\Modal;
use humhub\widgets\modal\ModalButton;

/* @var $this \humhub\components\View */
/* @var $model WorkingStatusUser */
/* @var $typeOptions array */

$title = $model->isNewRecord
    ? Yii::t('WorkingStatusModule.base', '<strong>Set</strong> your working status')
    : Yii::t('WorkingStatusModule.base', '<strong>Change</strong> your working status');
?>

<?php $form = Modal::beginFormDialog([
    'title' => $title,
    'footer' => ModalButton::cancel() . ModalButton::save()->submit(),
]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        $typeOptions,
        ['prompt' => Yii::t('WorkingStatusModule.base', 'Select a status...')],
    ) ?>

    <?= $form->field($model, 'custom_text')->textarea([
        'rows' => 2,
        'maxlength' => WorkingStatusUser::NOTE_MAX_LENGTH,
        'placeholder' => Yii::t('WorkingStatusModule.base', 'Optional note (e.g. back at 3pm)'),
    ]) ?>

<?php Modal::endFormDialog() ?>
