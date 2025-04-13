<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detailkelompokkelas;
class DetailkelompokkelasSearch extends Detailkelompokkelas{
    public function rules(){
        return [
            [['id_detail', 'id_kelompok', 'id_murid'], 'integer'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Detailkelompokkelas::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_detail' => $this->id_detail,
            'id_kelompok' => $this->id_kelompok,
            'id_murid' => $this->id_murid,
        ]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
