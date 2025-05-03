<?php

namespace app\models;

use Yii;
use app\models\GeneralModelsTrait;

class Ujikompetensi extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName()
    {
        return 'uji_kompetensi';
    }
    public function rules()
    {
        return [
            [['id_mapel', 'id_materi'], 'integer'],
            [['tanggal_dibuat', 'tanggal_akhir'], 'safe'],
            [['keterangan'], 'string'],
            [['nama_ujikompetensi', 'status'], 'string', 'max' => 255],
            [['id_mapel'], 'exist', 'skipOnError' => true, 'targetClass' => Matapelajaran::class, 'targetAttribute' => ['id_mapel' => 'id_mapel']],
            [['id_materi'], 'exist', 'skipOnError' => true, 'targetClass' => Materi::class, 'targetAttribute' => ['id_materi' => 'id_materi']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_uji' => 'Id Uji',
            'id_mapel' => 'Id Mapel',
            'id_materi' => 'Id Materi',
            'nama_ujikompetensi' => 'Nama Ujikompetensi',
            'tanggal_dibuat' => 'Tanggal Mulai',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'tanggal_akhir' => 'Tanggal Akhir',
        ];
    }
    public function getMapel()
    {
        return $this->hasOne(Matapelajaran::class, ['id_mapel' => 'id_mapel']);
    }
    public function getMateri()
    {
        return $this->hasOne(Materi::class, ['id_materi' => 'id_materi']);
    }
    public function getSoals()
    {
        return $this->hasMany(Soal::class, ['id_uji' => 'id_uji']);
    }
}
