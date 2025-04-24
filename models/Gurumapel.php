<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Gurumapel extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'guru_mapel';
    }
    public function rules(){
        return [
            [['id_guru', 'id_mapel'], 'integer'],
            [['status', 'catatan'], 'string', 'max' => 255],
            [['id_guru'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['id_guru' => 'id_pegawai']],
            [['id_mapel'], 'exist', 'skipOnError' => true, 'targetClass' => Matapelajaran::class, 'targetAttribute' => ['id_mapel' => 'id_mapel']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_guru_mapel' => 'Id Guru Mapel',
            'id_guru' => 'Id Guru',
            'id_mapel' => 'Id Mapel',
            'status' => 'Status',
            'catatan' => 'Catatan',
        ];
    }
    public function getGuru(){
        return $this->hasOne(Pegawai::class, ['id_pegawai' => 'id_guru']);
    }
    public function getMapel(){
        return $this->hasOne(Matapelajaran::class, ['id_mapel' => 'id_mapel']);
    }
}
