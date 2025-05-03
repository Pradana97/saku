<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Jawaban extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'jawaban';
    }
    public function rules(){
        return [
            [['id_soal'], 'integer'],
            [['jawab', 'apa_benar'], 'string', 'max' => 255],
            [['id_soal'], 'exist', 'skipOnError' => true, 'targetClass' => Soal::class, 'targetAttribute' => ['id_soal' => 'id_soal']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_jawaban' => 'Id Jawaban',
            'id_soal' => 'Id Soal',
            'jawab' => 'Jawab',
            'apa_benar' => 'Apa Benar',
        ];
    }
    public function getJawabanUsers(){
        return $this->hasMany(JawabanUser::class, ['id_jawaban' => 'id_jawaban']);
    }
    public function getSoal(){
        return $this->hasOne(Soal::class, ['id_soal' => 'id_soal']);
    }
}
