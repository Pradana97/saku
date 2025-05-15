<?php

use app\models\Jawabanuser;
use yii\helpers\Html;

$this->title = '';
$this->registerCssFile('https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', ['position' => \yii\web\View::POS_END]);

?>
<div>

</div>
<!--  -->
<div>
    <h3 style="text-align: center;">
        HASIL NILAI DARI SOAL PILIHAN GANDA MATA PELAJARAN <?= $namamapel; ?>
    </h3>
    <hr style="width: 80%;">
    <table id="tabel-nilai" class="display" style="width: 100%; border-collapse: collapse;" border="0">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Materi</th>
                <th>Nama Uji kompetensi</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $row):
                $cekbenar = Jawabanuser::find()
                    ->where(['id_uji' => $row['id_uji'], 'apa_benar' => 'Y'])
                    ->count();
                $nilaisatuan = 100 * 1 /  $row['total_jawaban'];
                $totalnilai = $cekbenar * $nilaisatuan;
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['namamateri']; ?></td>
                    <td><?= $row['namauji'] ?></td>
                    <td><?= round($totalnilai, 2); ?></td>
                    <td>
                        <?= \yii\helpers\Html::a('Cetak PDF', ['jawabanuser/cetakganda', 'nd' => $row['id_uji']], [
                            'class' => 'btn btn-success btn-sm'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<hr>
<!--  -->
<br>
<div>
    <h3 style="text-align: center;">
        HASIL NILAI DARI SOAL URAIAN MATA PELAJARAN <?= $namamapel; ?>
    </h3>
    <hr style="width: 80%;">
    <table id="tabel-nilai2" class="display" style="width: 100%; border-collapse: collapse;" border="0">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Materi</th>
                <th>Nama Uji kompetensi</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nos = 1;
            foreach ($data2 as $rows):
                $url = Yii::getAlias('@web/uploads/jawabanuser/' . $rows['id_jawabanuser'] . $rows['dokumen']);
            ?>
                <tr>
                    <td><?= $nos++; ?></td>
                    <td><?= $rows['nama_materi']; ?></td>
                    <td><?= $rows['nama_ujikompetensi'] ?></td>
                    <td><?= $rows['nilai'] ?></td>
                    <td>
                        <?= Html::a('Lihat / Unduh Dokumen', $url, ['target' => '_blank']); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!--  -->
<?php
$this->registerJs("
    $(document).ready(function() {
        $('#tabel-nilai').DataTable({
            'paging': true,
            'searching': true,
            'ordering': true
        });
    });
");
?>
<?php
$this->registerJs("
    $(document).ready(function() {
        $('#tabel-nilai2').DataTable({
            'paging': true,
            'searching': true,
            'ordering': true
        });
    });
");
?>