<?php

namespace app\models;

use Yii;
use app\models\GeneralModelsTrait;

class Jawabanuseruraian extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName()
    {
        return 'jawaban_user_uraian';
    }
    public function rules()
    {
        return [
            [['id_uji', 'user_id'], 'integer'],
            [['nilai', 'dokumen'], 'string', 'max' => 255],
            [['id_uji'], 'exist', 'skipOnError' => true, 'targetClass' => UjiKompetensi::class, 'targetAttribute' => ['id_uji' => 'id_uji']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_jawabanuser' => 'Id Jawabanuser',
            'id_uji' => 'Id Uji',
            'user_id' => 'User ID',
            'nilai' => 'Nilai',
            'dokumen' => 'Dokumen',
        ];
    }
    public function getUji()
    {
        return $this->hasOne(UjiKompetensi::class, ['id_uji' => 'id_uji']);
    }
}
