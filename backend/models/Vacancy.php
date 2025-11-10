<?php
namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
class Vacancy extends ActiveRecord
{
    public static function tableName() { return 'vacancy'; }
    public function rules() {
        return [
            [['title','description','salary'], 'required'],
            ['title','string','max'=>255],
            ['description','string'],
            ['salary','integer','min'=>0],
        ];
    }
    public function behaviors(){ return [TimestampBehavior::class]; }
    public function fields(){ return ['id','title','salary','description','created_at','updated_at']; }
}