<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Msmapel;
class MsmapelSearch extends Msmapel{
    public function rules(){
        return [
            [['id_msmapel'], 'integer'],
            [['nama', 'status'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Msmapel::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_msmapel' => $this->id_msmapel,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
