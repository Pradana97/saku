<?php
use yii\helpers\{Html,ArrayHelper,Url};
use yii\widgets\ActiveForm;
?>
<div class="jawaban-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_soal')->textInput() ?>

    <?= $form->field($model, 'jawab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apa_benar')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>
