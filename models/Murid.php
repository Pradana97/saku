<?php
namespace app\models;
use Yii;
use app\models\GeneralModelsTrait;
class Murid extends \yii\db\ActiveRecord
{
    use GeneralModelsTrait;
    public static function tableName(){
        return 'murid';
    }
    public function rules(){
        return [
            [['tgl_lahir'], 'safe'],
            [['kelas', 'jurusan', 'user_id'], 'integer'],
            [['catatan'], 'string'],
            [['nama', 'no_induk_sekolah', 'no_identitas', 'tempat_lahir', 'jenis_kelamin', 'alamat', 'no_tlp_ortu', 'tahun_masuk', 'status', 'nama_ortu', 'status_beasiswa', 'foto'], 'string', 'max' => 255],
            [['kelas'], 'exist', 'skipOnError' => true, 'targetClass' => MsKelas::class, 'targetAttribute' => ['kelas' => 'id_kelas']],
            [['jurusan'], 'exist', 'skipOnError' => true, 'targetClass' => MsJurusan::class, 'targetAttribute' => ['jurusan' => 'id_jurusan']],
        ];
    }
    public function attributeLabels(){
        return [
            'id_murid' => 'Id Murid',
            'nama' => 'Nama',
            'no_induk_sekolah' => 'No Induk Sekolah',
            'no_identitas' => 'No Identitas',
            'tgl_lahir' => 'Tgl Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'no_tlp_ortu' => 'No Tlp Ortu',
            'kelas' => 'Kelas',
            'jurusan' => 'Jurusan',
            'tahun_masuk' => 'Tahun Masuk',
            'status' => 'Status',
            'nama_ortu' => 'Nama Ortu',
            'status_beasiswa' => 'Status Beasiswa',
            'foto' => 'Foto',
            'catatan' => 'Catatan',
            'user_id' => 'User ID',
        ];
    }
    public function getDetailKelompokKelas(){
        return $this->hasMany(DetailKelompokKelas::class, ['id_murid' => 'id_murid']);
    }
    public function getJurusan0(){
        return $this->hasOne(MsJurusan::class, ['id_jurusan' => 'jurusan']);
    }
    public function getKelas0(){
        return $this->hasOne(MsKelas::class, ['id_kelas' => 'kelas']);
    }
}
