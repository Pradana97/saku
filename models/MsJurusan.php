<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class MsJurusan extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'ms_jurusan';
    }
    public function rules(){
        return [
            [['nama_jurusan', 'status'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id_jurusan' => 'Id Jurusan',
            'nama_jurusan' => 'Nama Jurusan',
            'status' => 'Status',
        ];
    }
    public function getMurs(){
        return $this->hasMany(Murid::class, ['jurusan' => 'id_jurusan']);
    }
}
