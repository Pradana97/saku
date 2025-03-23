<?php
use yii\helpers\{Html,ArrayHelper,Url};
use yii\widgets\ActiveForm;
?>
<div class="bannerberanda-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'foto')->fileInput(['onchange' => 'previewImage(this)'])->label('File') ?>

	<div class="row">
		<div class="col-sm-6">
			<div id="imagePreview"></div>
		</div>
		<div class="col-sm-6">
			<?php 
				if($model->foto != null){
			?>
				<p>File Sebelumnya</p>
				<p style="width: 10%;">
				<?= Html::img(Yii::getAlias('@web/uploads/bannerberanda/'.$model->id.$model->foto), ['style' => ['width' => '200px']]) ?>
				</p>
			<?php } ?>
		</div>
	</div>

	<?= $form->field($model, 'status')->widget(\kartik\select2\Select2::classname(), [
            // 'disabled'=>'readonly',
            'data' => [1 => 'Aktif', 0 => 'Tidak Aktif'],
            'language' => 'de',
            'options' => ['placeholder' => 'Status Banner ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Status');?>

    <?= $form->field($model, 'utama')->widget(\kartik\select2\Select2::classname(), [
            // 'disabled'=>'readonly',
            'data' => [1 => 'iya', 0 => 'Tidak'],
            'language' => 'de',
            'options' => ['placeholder' => 'Status ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ])->label('Apakah Utama ?');?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '200px'; // Atur lebar gambar pratinjau
            img.style.height = 'auto'; // Atur tinggi gambar pratinjau
            preview.appendChild(img);
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        var img = document.createElement('img');
        img.src = ''; // Sumber gambar pratinjau kosong
        preview.appendChild(img);
    }
}
</script>
