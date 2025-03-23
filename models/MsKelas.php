<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class MsKelas extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'ms_kelas';
    }
    public function rules(){
        return [
            [['nama_kelas', 'status'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id_kelas' => 'Id Kelas',
            'nama_kelas' => 'Nama Kelas',
            'status' => 'Status',
        ];
    }
    public function getMurs(){
        return $this->hasMany(Murid::class, ['kelas' => 'id_kelas']);
    }
}
