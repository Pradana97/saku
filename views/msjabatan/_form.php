<?php

use yii\helpers\{Html, ArrayHelper, Url};
use yii\widgets\ActiveForm;
?>
<div class="ms-jabatan-form">
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'nama_jabatan')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
		'pluginOptions' => [
			'onText' => 'Aktif',
			'offText' => 'Nonaktif',
			'onColor' => 'success',
			'offColor' => 'danger',
		]
	]) ?>


	<?php if (!Yii::$app->request->isAjax) { ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>
	<?php ActiveForm::end(); ?>
</div>