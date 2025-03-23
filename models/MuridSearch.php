<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Murid;
class MuridSearch extends Murid{
    public function rules(){
        return [
            [['id_murid', 'kelas', 'jurusan', 'user_id'], 'integer'],
            [['nama', 'no_induk_sekolah', 'no_identitas', 'tgl_lahir', 'tempat_lahir', 'jenis_kelamin', 'alamat', 'no_tlp_ortu', 'tahun_masuk', 'status', 'nama_ortu', 'status_beasiswa', 'foto', 'catatan'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Murid::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_murid' => $this->id_murid,
            'tgl_lahir' => $this->tgl_lahir,
            'kelas' => $this->kelas,
            'jurusan' => $this->jurusan,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_induk_sekolah', $this->no_induk_sekolah])
            ->andFilterWhere(['like', 'no_identitas', $this->no_identitas])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_tlp_ortu', $this->no_tlp_ortu])
            ->andFilterWhere(['like', 'tahun_masuk', $this->tahun_masuk])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'nama_ortu', $this->nama_ortu])
            ->andFilterWhere(['like', 'status_beasiswa', $this->status_beasiswa])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
