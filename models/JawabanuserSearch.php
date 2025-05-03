<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jawabanuser;
class JawabanuserSearch extends Jawabanuser{
    public function rules(){
        return [
            [['id_jawabanuser', 'id_soal', 'id_jawaban', 'user_id'], 'integer'],
            [['apa_benar'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Jawabanuser::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_jawabanuser' => $this->id_jawabanuser,
            'id_soal' => $this->id_soal,
            'id_jawaban' => $this->id_jawaban,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'apa_benar', $this->apa_benar]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
