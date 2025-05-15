<?php

use yii\helpers\Url;

$this->title = '';
?>

<style>
    .menu-box {
        position: relative;
        background-color: rgb(60, 188, 135);
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
<h3 style="text-align: center;"><?= 'PILIH MATERI DARI MAPEL' . $namamapel ?></h3>
<hr style="margin-top: 5px; width: 50%;">

<div>
    <div class="col-12">
        <div class="row">
            <?php
            foreach ($datamateri as $row) :
            ?>
                <div class="col-md-3">
                    <div class="menu-box">
                        <div class="menu-title" style="color: white; font-size: 18px;"><?= $row->nama_materi; ?></div>
                        <div><i class="fa fa-print" style="font-size: 70px;"></i></div>
                        <a href="<?= Url::toRoute(['soal/pilihujikompetensi', 'nd' => $row->id_materi]); ?>" class="menu-link">
                            <div class="hover-text">BUKA</div>
                        </a>
                    </div>
                </div>
            <?php
            endforeach
            ?>
        </div>
    </div>
</div>