<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Detailkelompokkelas extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'detail_kelompok_kelas';
    }
    public function rules(){
        return [
            [['id_kelompok', 'id_murid'], 'integer'],
            [['id_kelompok'], 'exist', 'skipOnError' => true, 'targetClass' => KelompokKelas::class, 'targetAttribute' => ['id_kelompok' => 'id_kelompok']],
            [['id_murid'], 'exist', 'skipOnError' => true, 'targetClass' => Murid::class, 'targetAttribute' => ['id_murid' => 'id_murid']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_detail' => 'Id Detail',
            'id_kelompok' => 'Id Kelompok',
            'id_murid' => 'Id Murid',
        ];
    }
    public function getMur(){
        return $this->hasOne(Murid::class, ['id_murid' => 'id_murid']);
    }
    public function getKelompok(){
        return $this->hasOne(KelompokKelas::class, ['id_kelompok' => 'id_kelompok']);
    }
}
