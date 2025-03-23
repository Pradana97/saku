<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bannerberanda;
class BannerberandaSearch extends Bannerberanda{
    public function rules(){
        return [
            [['id', 'status','utama'], 'integer'],
            [['keterangan', 'foto'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = Bannerberanda::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'utama' => $this->utama,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'foto', $this->foto]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
