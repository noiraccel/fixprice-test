<?php
use yii\db\Migration;
class m210101_000001_create_vacancies_table extends Migration
{
    public function safeUp() {
        $this->createTable('{{%vacancy}}',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(255)->notNull(),
            'description'=>$this->text()->notNull(),
            'salary'=>$this->integer()->notNull()->defaultValue(0),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull(),
        ]);
    }
    public function safeDown(){ $this->dropTable('{{%vacancy}}'); }
}