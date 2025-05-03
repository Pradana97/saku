<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Jawabanuser extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'jawaban_user';
    }
    public function rules(){
        return [
            [['id_soal', 'id_jawaban', 'user_id'], 'integer'],
            [['apa_benar'], 'string', 'max' => 255],
            [['id_soal'], 'exist', 'skipOnError' => true, 'targetClass' => Soal::class, 'targetAttribute' => ['id_soal' => 'id_soal']],
            [['id_jawaban'], 'exist', 'skipOnError' => true, 'targetClass' => Jawaban::class, 'targetAttribute' => ['id_jawaban' => 'id_jawaban']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_jawabanuser' => 'Id Jawabanuser',
            'id_soal' => 'Id Soal',
            'id_jawaban' => 'Id Jawaban',
            'user_id' => 'User ID',
            'apa_benar' => 'Apa Benar',
        ];
    }
    public function getJawaban(){
        return $this->hasOne(Jawaban::class, ['id_jawaban' => 'id_jawaban']);
    }
    public function getSoal(){
        return $this->hasOne(Soal::class, ['id_soal' => 'id_soal']);
    }
}
