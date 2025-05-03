<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ujikompetensi;

class UjikompetensiSearch extends Ujikompetensi
{
    public function rules()
    {
        return [
            [['id_uji', 'id_mapel', 'id_materi'], 'integer'],
            [['nama_ujikompetensi', 'tanggal_dibuat', 'keterangan', 'status', 'tanggal_akhir'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Ujikompetensi::find()->where($where)->joinWith(['mapel', 'materi']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        // $query->andFilterWhere([
        //     'id_uji' => $this->id_uji,
        //     'id_mapel' => $this->id_mapel,
        //     'id_materi' => $this->id_materi,
        //     'tanggal_dibuat' => $this->tanggal_dibuat,
        // ]);

        $query->andFilterWhere([

            'uji_kompetensi.id_mapel' => $this->id_mapel,
            'uji_kompetensi.id_materi' => $this->id_materi,
            'tanggal_dibuat' => $this->tanggal_dibuat,
            'tanggal_akhir' => $this->tanggal_akhir,
        ]);


        $query->andFilterWhere(['like', 'nama_ujikompetensi', $this->nama_ujikompetensi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'uji_kompetensi.status', $this->status]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
