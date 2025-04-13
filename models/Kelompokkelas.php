<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Kelompokkelas extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'kelompok_kelas';
    }
    public function rules(){
        return [
            [['nama_kelompok', 'status', 'catatan'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id_kelompok' => 'Id Kelompok',
            'nama_kelompok' => 'Nama Kelompok',
            'status' => 'Status',
            'catatan' => 'Catatan',
        ];
    }
    public function getDetailKelompokKelas(){
        return $this->hasMany(DetailKelompokKelas::class, ['id_kelompok' => 'id_kelompok']);
    }
    public function getMatapelajarans(){
        return $this->hasMany(Matapelajaran::class, ['id_kelompok' => 'id_kelompok']);
    }
}
