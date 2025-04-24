<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materi;

class MateriSearch extends Materi
{
    public function rules()
    {
        return [
            [['id_materi', 'id_mapel'], 'integer'],
            [['nama_materi', 'created_date', 'keterangan', 'dokumen'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Materi::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_materi' => $this->id_materi,
            'id_mapel' => $this->id_mapel,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'nama_materi', $this->nama_materi])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
