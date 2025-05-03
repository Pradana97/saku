<?php
use yii\widgets\DetailView;
?>
<div class="jawaban-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_jawaban',
            'id_soal',
            'jawab',
            'apa_benar',
        ],
    ]) ?>
</div>