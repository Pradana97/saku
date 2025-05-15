<?php

use app\models\Jawaban;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '';
?>
<div>
    <h3 style="text-align: center;">SOAL PILIHAN GANDA : <?= $judul; ?></h3>
    <hr style="width: 50%;">
</div>
<div>
    <?php $form = ActiveForm::begin([
        'action' => ['soal/simpan-jawaban'],
        'method' => 'post',
        'options' => ['id' => 'form-jawaban']
    ]); ?>

    <table style="width: 100%; margin-left: 5%;">
        <?php
        $no = 1;
        $idSoalList = []; // untuk disimpan dan dipakai di JS
        foreach ($soal as $row):
            $idSoalList[] = $row->id_soal;
        ?>
            <tr>
                <td style="font-weight: bold;"><?= $no++; ?></td>
                <td style="font-weight: bold;" colspan="4"><?= $row->soal; ?></td>
            </tr>
            <tr>
                <td></td>
                <?php
                $pilihanjawaban = Jawaban::find()->where(['id_soal' => $row->id_soal])->all();
                foreach ($pilihanjawaban as $rows):
                ?>
                    <td>
                        <label style="font-weight: normal;">
                            <input type="radio" name="Jawabanuserganda[<?= $row->id_soal ?>]" value="<?= $rows->id_jawaban ?>">
                            <?= $rows->jawab ?>
                        </label>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
        <?php endforeach; ?>
        <input type="hidden" name="id_uji" value="<?= $nd ?>">
    </table>

    <div class="form-group" style="margin-left: 5%;">
        <?= Html::button('Simpan Jawaban', ['class' => 'btn btn-success', 'id' => 'btn-simpan']) ?>

    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- JavaScript validasi dan kirim AJAX -->
<script>
    document.getElementById('btn-simpan').addEventListener('click', function(e) {
        const form = document.getElementById('form-jawaban');
        const formData = new FormData(form);
        const idSoalList = <?= json_encode($idSoalList) ?>;
        let belumTerjawab = [];

        idSoalList.forEach(function(id) {
            const radios = document.querySelectorAll(`input[name="Jawabanuserganda[${id}]"]`);
            let terjawab = false;
            radios.forEach(r => {
                if (r.checked) terjawab = true;
            });
            if (!terjawab) belumTerjawab.push(id);
        });

        if (belumTerjawab.length > 0) {
            alert("Masih ada soal yang belum dijawab. Harap jawab semua soal.");
            return;
        }

        if (!confirm("Yakin ingin menyimpan jawaban?")) {
            return;
        }

        // Kirim via AJAX
        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Jawaban berhasil disimpan.");
                    window.location.href = data.redirectUrl;
                } else {
                    alert("Terjadi kesalahan saat menyimpan.");
                }
            })
            .catch(error => {
                alert("Gagal mengirim data.");
                console.error(error);
            });
    });
</script>