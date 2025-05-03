<?php
use yii\helpers\{Html,ArrayHelper,Url};
use yii\widgets\ActiveForm;
?>
<div class="soal-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_uji')->textInput() ?>

    <?= $form->field($model, 'soal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>
