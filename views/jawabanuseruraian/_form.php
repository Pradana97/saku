<?php
use yii\helpers\{Html,ArrayHelper,Url};
use yii\widgets\ActiveForm;
?>
<div class="jawabanuseruraian-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_jawabanuser')->textInput() ?>

    <?= $form->field($model, 'id_uji')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>
