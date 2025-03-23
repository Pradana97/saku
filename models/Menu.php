<?php
namespace app\models;
use Yii;
use \mdm\admin\components\Helper;
class Menu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'ms_menu';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route', 'icon'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'route' => 'Route',
            'order' => 'Order',
            'data' => 'Data',
            'icon' => 'Icon',
        ];
    }
    public static function getMenu($cnd=NULL){
        $data2 = [];
        $menu=Menu::find()->cache(10000)->where(['parent' => $cnd])->orderby('order')->all();
        foreach($menu as $haha)
        {
            $row=[];
            $row['id']     = $haha->id;
            $row['label']  = $haha->name;
            $row['icon']  = $haha->icon;
            $row['url']    = [$haha->route];
            $row['visible']    = Helper::checkRoute($haha->route);
            if(count(self::getMenu($haha->id))>0)
                $row['items'] = self::getMenu($haha->id);
            $data2[] =$row;
        }
        return $data2;
    }
}
