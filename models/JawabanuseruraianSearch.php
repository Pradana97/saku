<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jawabanuseruraian;

class JawabanuseruraianSearch extends Jawabanuseruraian
{
    public function rules()
    {
        return [
            [['id_jawabanuser', 'id_uji', 'user_id'], 'integer'],
            [['nilai', 'dokumen'], 'safe'],
        ];
    }
    public function scenarios()
    {
        return Model::scenarios();
    }
    public function search($params, $where = null)
    {
        $query = Jawabanuseruraian::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_jawabanuser' => $this->id_jawabanuser,
            'id_uji' => $this->id_uji,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nilai', $this->nilai])
            ->andFilterWhere(['like', 'dokumen', $this->dokumen]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
