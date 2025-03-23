<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Bannerberanda extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'bannerberanda';
    }
    public function rules(){
        return [
            [['keterangan'], 'string'],
            [['status','utama'], 'integer'],
            [['foto'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
            'foto' => 'Foto',
            'status' => 'Status',
            'utama' => 'Utama',
        ];
    }
}
