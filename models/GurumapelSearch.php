<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gurumapel;
class GurumapelSearch extends Gurumapel{
    public function rules(){
        return [
            [['id_guru_mapel', 'id_guru', 'id_mapel'], 'integer'],
            [['status', 'catatan'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Gurumapel::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_guru_mapel' => $this->id_guru_mapel,
            'id_guru' => $this->id_guru,
            'id_mapel' => $this->id_mapel,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
