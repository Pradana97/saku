<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsKelas;
class MskelasSearch extends MsKelas{
    public function rules(){
        return [
            [['id_kelas'], 'integer'],
            [['nama_kelas', 'status'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = MsKelas::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_kelas' => $this->id_kelas,
        ]);

        $query->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
