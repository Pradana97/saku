<?php

use yii\helpers\Url;

$this->title = '';
?>

<style>
    .menu-box {
        position: relative;
        background-color: #3c8dbc;
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
<h3 style="text-align: center;"><?= 'PILIH MATA PELAJARAN KELAS' . $datakelompokkelas ?></h3>
<hr style="margin-top: 5px; width: 50%;">
<div>
    <div class="col-12">
        <div class="row">
            <?php
            foreach ($datamatapelajaran as $row) :
            ?>
                <div class="col-md-3">
                    <div class="menu-box">
                        <div class="menu-title" style="color: white;"><?= $row->msmapel->nama; ?></div>
                        <a href="<?= Url::toRoute(['materi/materinya', 'nd' => $row->id_mapel, 'namamapel' => $row->msmapel->nama]); ?>" class="menu-link">
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

<!-- $datamatapelajaran[0]['msmapel']->nama; -->