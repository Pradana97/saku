<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pegawai;

class PegawaiSearch extends Pegawai
{
    public function rules()
    {
        return [
            [['id_pegawai', 'jabatan', 'id_user'], 'integer'],
            [['nama', 'nik', 'nip', 'tgl_lahir', 'jenis_kelamin', 'alamat', 'no_tlp', 'email', 'foto'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Pegawai::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_pegawai' => $this->id_pegawai,
            'tgl_lahir' => $this->tgl_lahir,
            'jabatan' => $this->jabatan,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'no_tlp', $this->no_tlp])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'email', $this->email]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
