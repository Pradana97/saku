<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Materi extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'materi';
    }
    public function rules(){
        return [
            [['id_mapel'], 'integer'],
            [['created_date'], 'safe'],
            [['keterangan'], 'string'],
            [['nama_materi', 'dokumen'], 'string', 'max' => 255],
            [['id_mapel'], 'exist', 'skipOnError' => true, 'targetClass' => Matapelajaran::class, 'targetAttribute' => ['id_mapel' => 'id_mapel']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_materi' => 'Id Materi',
            'id_mapel' => 'Id Mapel',
            'nama_materi' => 'Nama Materi',
            'created_date' => 'Created Date',
            'keterangan' => 'Keterangan',
            'dokumen' => 'Dokumen',
        ];
    }
    public function getMapel(){
        return $this->hasOne(Matapelajaran::class, ['id_mapel' => 'id_mapel']);
    }
    public function getUjiKompetensis(){
        return $this->hasMany(UjiKompetensi::class, ['id_materi' => 'id_materi']);
    }
}
