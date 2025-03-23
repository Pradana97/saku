<?php

namespace app\models;

use Yii;
use app\models\GeneralModelsTrait;

class Pegawai extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName()
    {
        return 'pegawai';
    }
    public function rules()
    {
        return [
            [['tgl_lahir'], 'safe'],
            [['jabatan', 'id_user'], 'integer'],
            [['nama', 'nik', 'nip', 'jenis_kelamin', 'alamat', 'no_tlp', 'email', 'foto'], 'string', 'max' => 255],
            [['jabatan'], 'exist', 'skipOnError' => true, 'targetClass' => MsJabatan::class, 'targetAttribute' => ['jabatan' => 'id_jabatan']],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'nama' => 'Nama',
            'nik' => 'Nik',
            'nip' => 'Nip',
            'tgl_lahir' => 'Tgl Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'no_tlp' => 'No Tlp',
            'email' => 'Email',
            'jabatan' => 'Jabatan',
            'foto' => 'Foto',
            'id_user' => 'Id User'
        ];
    }
    public function getGuruMapels()
    {
        return $this->hasMany(GuruMapel::class, ['id_guru' => 'id_pegawai']);
    }
    public function getJabatan0()
    {
        return $this->hasOne(MsJabatan::class, ['id_jabatan' => 'jabatan']);
    }
}
