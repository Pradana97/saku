<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class MsJabatan extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'ms_jabatan';
    }
    public function rules(){
        return [
            [['nama_jabatan', 'status'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id_jabatan' => 'Id Jabatan',
            'nama_jabatan' => 'Nama Jabatan',
            'status' => 'Status',
        ];
    }
    public function getPegawais(){
        return $this->hasMany(Pegawai::class, ['jabatan' => 'id_jabatan']);
    }
}
