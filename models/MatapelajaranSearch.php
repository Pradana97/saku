<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Matapelajaran;
class MatapelajaranSearch extends Matapelajaran{
    public function rules(){
        return [
            [['id_mapel', 'id_msmapel', 'id_kelompok'], 'integer'],
            [['status', 'catatan'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Matapelajaran::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_mapel' => $this->id_mapel,
            'id_msmapel' => $this->id_msmapel,
            'id_kelompok' => $this->id_kelompok,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
