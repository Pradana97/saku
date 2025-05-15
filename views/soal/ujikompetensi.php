<?php

use app\models\Jawaban;
use app\models\Jawabanuser;
use app\models\Jawabanuseruraian;
use app\models\Soal;
use app\models\Ujikompetensi;
use yii\helpers\Url;

$this->title = '';

?>

<style>
    .menu-box {
        position: relative;
        background-color: rgb(40, 110, 175);
        padding: 40px 20px;
        text-align: center;
        border-radius: 10px;
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .menu-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .menu-title {
        font-size: 20px;
        font-weight: bold;
        z-index: 1;
    }

    .hover-text {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        opacity: 0;
        transition: all 0.3s ease;
        color: rgb(255, 255, 255);
        font-weight: bold;
    }

    .menu-box:hover .hover-text {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
</style>
<h3 style="text-align: center;">PILIH UJI KOMPTENSI DARI MATERI <?= $model->ujikompetensi->nama_ujikompetensi ?? '' ?>
</h3>
<hr style="margin-top: 5px; width: 50%;">

<div>
    <div class="col-12">
        <div class="row">
            <?php
            foreach ($ujikompetensi as $row) :
            ?>
                <div class="col-md-3">
                    <div class="menu-box">
                        <div class="menu-title" style="color: white; font-size: 18px;"><?= $row->nama_ujikompetensi; ?></div>
                        <hr>
                        <div><i class="fa fa-print" style="font-size: 70px;"></i></div>
                        <div style="color: white; font-size: 12px;">
                            <br>
                            <table style="width: 100%;">
                                <tr>
                                    <td>Jenis Soal</td>
                                    <td style="width: 1%;">:</td>
                                    <td><?= $row->status; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Mulai</td>
                                    <td style="width: 1%;">:</td>
                                    <td><?= $row->tanggal_dibuat; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Mulai</td>
                                    <td style="width: 1%;">:</td>
                                    <td><?= $row->tanggal_akhir; ?></td>
                                </tr>
                                <tr>
                                    <td>status</td>
                                    <td style="width: 1%;">:</td>
                                    <td style="font-weight: bold; color: yellow;">
                                        <?php
                                        if ($row->status == 'ganda') {
                                            $soal = Soal::find()->where(['id_uji' => $row->id_uji])->one()->id_soal;
                                            $status = Jawabanuser::find()->where(['id_soal' => $soal])->andWhere(['user_id' =>  Yii::$app->user->identity->id])->one();
                                            if (!empty($status)) {
                                                echo 'Selesai Dikerjakan';
                                            } else {
                                                echo 'Belum Dikerjakan';
                                            }
                                        } else {
                                            $status = Jawabanuseruraian::find()->where(['id_uji' => $row->id_uji])->andWhere(['user_id' =>  Yii::$app->user->identity->id])->one();
                                            if (!empty($status)) {
                                                echo 'Selesai Dikerjakan';
                                            } else {
                                                echo 'Belum Dikerjakan';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php
                        if (!empty($row->tanggal_akhir) && $row->tanggal_akhir > date('Y-m-d')) {
                        ?>
                            <a href="<?= Url::toRoute(['soal/soal', 'nd' => $row->id_uji, 'jenis' => $row->status, 'judul' => $row->nama_ujikompetensi]); ?>" class="menu-link">
                                <div class="hover-text">BUKA</div>
                            </a>
                        <?php
                        } else {
                        ?>
                            <div class="hover-text" style="background-color: red; width: 100%; padding: 3px;">WAKTU HABIS / UJI KOMPETENSI NON AKTIF</div>
                            <?php } ?>
                            </div>
                    </div>
                <?php
            endforeach
                ?>
                </div>
        </div>
    </div>