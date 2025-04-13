<?php
use yii\helpers\{Html,ArrayHelper,Url};
use yii\widgets\ActiveForm;
?>
<div class="detailkelompokkelas-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_kelompok')->textInput() ?>

    <?= $form->field($model, 'id_murid')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>
