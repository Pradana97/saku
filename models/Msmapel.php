<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Msmapel extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'ms_mapel';
    }
    public function rules(){
        return [
            [['nama', 'status'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id_msmapel' => 'Id Msmapel',
            'nama' => 'Nama',
            'status' => 'Status',
        ];
    }
    public function getMatapelajarans(){
        return $this->hasMany(Matapelajaran::class, ['id_msmapel' => 'id_msmapel']);
    }
}
