<?php
namespace app\models;
trait GeneralModelsTrait{
    public function getHash(){
        $class=self::class;
        $class=strpos($class,'Search')?str_replace('Search','',$class):$class;
        return md5($class);
    }
    public function range($d,$type){ //filter condition date between
        $dates = explode(' - ', $d);//return array
        if((bool) strtotime($dates[0]) && (bool) strtotime ($dates[1])) {
            return $type=='s'?$dates[0]:$dates[1];
        }
    }
    public static function where($condition, $params = []){
        return self::find()->cache(100)->where($condition, $params = []);
    }
    public static function first($condition){
        return self::find()->cache(100)->where($condition)->one();
    }
    public static function collectAll($condition=null, $params = []){
        if(isset($params) || isset($condition)){
            return collect(self::where($condition, $params = [])->all());
        }else{
            return collect(self::find()->cache(100)->all());
        }
    }

}