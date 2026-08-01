<?php

use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\modules\workingStatus\widgets\ConfigMenu;
use humhub\widgets\bootstrap\Button;
use humhub\widgets\form\ActiveForm;

/* @var $this \humhub\components\View */
/* @var $model WorkingStatusType */
?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Working Status</strong> configuration</div>

    <?= ConfigMenu::widget() ?>

    <div class="panel-body">
        <h4><?= Yii::t('WorkingStatusModule.base', 'Create new status type') ?></h4>

        <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'name')->textInput([
                'maxlength' => 100,
                'autofocus' => '',
                'placeholder' => Yii::t('WorkingStatusModule.base', 'e.g. In a meeting'),
            ]) ?>

            <?= $form->field($model, 'color')->colorInput() ?>

            <?= $form->field($model, 'sort_order')->input('number', ['min' => 0]) ?>

            <?= Button::save()->submit() ?>
            <?= Button::defaultType(Yii::t('WorkingStatusModule.base', 'Cancel'))
                ->link(['/working-status/config/index']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>