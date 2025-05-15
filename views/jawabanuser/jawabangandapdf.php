<?php

use app\models\Jawaban;
use app\models\Jawabanuser;
use app\models\Soal;

$cekbenar = Jawabanuser::find()
    ->where(['id_uji' => $soal[0]['id_uji'], 'apa_benar' => 'Y'])
    ->count();
$jumlahsoal = Soal::find()->where(['id_uji' => $soal[0]['id_uji']])->count();
$nilaisatuan = 100 * 1 /  $jumlahsoal;
$totalnilai = $cekbenar * $nilaisatuan;
?>
<!--  -->
<div style="text-align: center; font-family: 'Times New Roman', Times, serif;">
    <br>
    <h3>HASIL PENGERJAAN SOAL PILIHAN GANDA</h3>
    <br>
    <table border="1" style="width: 100%; border-collapse: collapse; font-family: 'Times New Roman', Times, serif; font-size: 12px;">
        <tr>
            <td style="width: 50%; padding: 5px;">Nama : <?= $datamurid->nama ?></td>
            <td style="width: 50%; padding: 5px;">Materi : <?= $soal[0]['uji']['materi']['nama_materi']; ?> </td>
        </tr>
        <tr>
            <td style="width: 50%; padding: 5px;">Uji Kompetensi : <?= $soal[0]['uji']['nama_ujikompetensi']; ?></td>
            <td style="width: 50%; padding: 5px; font-weight: bold;">Nilai : <?= $totalnilai; ?> </td>
        </tr>
    </table>
</div>
<br>
<!-- <hr style="margin-top: 0px;"> -->
<div>
    <table style="width: 100%; font-family: 'Times New Roman', Times, serif; font-size: 12px;">
        <?php
        $no = 1;
        foreach ($soal as $row):
        ?>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 5px; padding: 5px; font-weight: bold;"><?= $no++; ?></td>
                <td style="padding: 5px; font-weight: bold;" colspan="4"><?= $row->soal; ?></td>
            </tr>
            <tr>
                <td></td>
                <?php
                $jawaban = Jawaban::find()->where(['id_soal' => $row->id_soal])->all();
                foreach ($jawaban as $rows):
                ?>
                    <td>
                        <?=
                        $rows->jawab
                            . (
                                $rows->apa_benar === 'Y'
                                ? ' <span style="color: green; font-weight: bold;">●</span>'
                                : ' <span style="color: red; font-weight: bold;">X</span>'
                            )
                        ?>
                    </td>
                <?php
                endforeach;
                ?>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <?php
                $jawabuser = Jawabanuser::find()->where(['id_soal' => $row->id_soal])->andWhere(['user_id' => Yii::$app->user->identity->id])->one();
                ?>
                <td colspan="4" style="font-weight: bold;"> Jawaban Anda : <?= $jawabuser->jawaban->jawab . ($jawabuser->apa_benar === 'Y'  ? ' <span style="color: green; font-weight: bold;">Benar</span>' : ' <span style="color: red; font-weight: bold;">Salah</span>'); ?></td>
            </tr>
            <tr>
                <td colspan="5">
                    <hr>
                </td>
            </tr>
        <?php
        endforeach
        ?>
    </table>
</div>