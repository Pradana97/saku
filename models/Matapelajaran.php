<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Matapelajaran extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'matapelajaran';
    }
    public function rules(){
        return [
            [['id_msmapel', 'id_kelompok'], 'integer'],
            [['status', 'catatan'], 'string', 'max' => 255],
            [['id_msmapel'], 'exist', 'skipOnError' => true, 'targetClass' => MsMapel::class, 'targetAttribute' => ['id_msmapel' => 'id_msmapel']],
            [['id_kelompok'], 'exist', 'skipOnError' => true, 'targetClass' => KelompokKelas::class, 'targetAttribute' => ['id_kelompok' => 'id_kelompok']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_mapel' => 'Id Mapel',
            'id_msmapel' => 'Mata Pelajaran',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'id_kelompok' => 'Kelompok Kelas',
        ];
    }
    public function getGuruMapels(){
        return $this->hasMany(GuruMapel::class, ['id_mapel' => 'id_mapel']);
    }
    public function getKelompok(){
        return $this->hasOne(KelompokKelas::class, ['id_kelompok' => 'id_kelompok']);
    }
    public function getMateris(){
        return $this->hasMany(Materi::class, ['id_mapel' => 'id_mapel']);
    }
    public function getMsmapel(){
        return $this->hasOne(MsMapel::class, ['id_msmapel' => 'id_msmapel']);
    }
    public function getUjiKompetensis(){
        return $this->hasMany(UjiKompetensi::class, ['id_mapel' => 'id_mapel']);
    }
}
