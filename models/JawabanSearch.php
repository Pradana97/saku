<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jawaban;
class JawabanSearch extends Jawaban{
    public function rules(){
        return [
            [['id_jawaban', 'id_soal'], 'integer'],
            [['jawab', 'apa_benar'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Jawaban::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_jawaban' => $this->id_jawaban,
            'id_soal' => $this->id_soal,
        ]);

        $query->andFilterWhere(['like', 'jawab', $this->jawab])
            ->andFilterWhere(['like', 'apa_benar', $this->apa_benar]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
