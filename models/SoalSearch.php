<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Soal;
class SoalSearch extends Soal{
    public function rules(){
        return [
            [['id_soal', 'id_uji'], 'integer'],
            [['soal', 'type', 'status'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Soal::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_soal' => $this->id_soal,
            'id_uji' => $this->id_uji,
        ]);

        $query->andFilterWhere(['like', 'soal', $this->soal])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
