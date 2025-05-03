<?php

namespace app\models;

use Yii;
use app\models\GeneralModelsTrait;

class Soal extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName()
    {
        return 'soal';
    }
    public function rules()
    {
        return [
            [['id_uji'], 'integer'],
            [['soal'], 'string'],
            [['type', 'status'], 'string', 'max' => 255],
            [['id_uji'], 'exist', 'skipOnError' => true, 'targetClass' => UjiKompetensi::class, 'targetAttribute' => ['id_uji' => 'id_uji']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_soal' => 'Id Soal',
            'id_uji' => 'Id Uji',
            'soal' => 'Soal',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
    public function getJawabanUsers()
    {
        return $this->hasMany(JawabanUser::class, ['id_soal' => 'id_soal']);
    }
    public function getJawabans()
    {
        return $this->hasMany(Jawaban::class, ['id_soal' => 'id_soal']);
    }
    public function getUji()
    {
        return $this->hasOne(UjiKompetensi::class, ['id_uji' => 'id_uji']);
    }
}
