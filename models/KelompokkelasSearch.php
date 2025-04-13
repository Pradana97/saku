<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kelompokkelas;
class KelompokkelasSearch extends Kelompokkelas{
    public function rules(){
        return [
            [['id_kelompok'], 'integer'],
            [['nama_kelompok', 'status', 'catatan'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Kelompokkelas::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_kelompok' => $this->id_kelompok,
        ]);

        $query->andFilterWhere(['like', 'nama_kelompok', $this->nama_kelompok])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
