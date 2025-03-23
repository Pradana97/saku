<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsJurusan;
class MsjurusanSearch extends MsJurusan{
    public function rules(){
        return [
            [['id_jurusan'], 'integer'],
            [['nama_jurusan', 'status'], 'safe'],
        ];
    }
    public function scenarios(){
        return Model::scenarios();
    }
    public function search($params,$where=null){
        $query = MsJurusan::find()->where($where);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'nama_jurusan', $this->nama_jurusan])
            ->andFilterWhere(['like', 'status', $this->status]);
        return $dataProvider;
    }
    //range move on generalmodeltraits
}
