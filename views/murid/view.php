<?php
use yii\widgets\DetailView;
?>
<div class="murid-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_murid',
            'nama',
            'no_induk_sekolah',
            'no_identitas',
            'tgl_lahir',
            'tempat_lahir',
            'jenis_kelamin',
            'alamat',
            'no_tlp_ortu',
            'kelas',
            'jurusan',
            'tahun_masuk',
            'status',
            'nama_ortu',
            'status_beasiswa',
            'foto',
            'catatan:ntext',
            'user_id',
        ],
    ]) ?>
</div>