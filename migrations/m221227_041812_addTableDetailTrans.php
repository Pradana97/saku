<?php
use yii\db\Migration;
class m221227_041812_addTableDetailTrans extends Migration
{
    public function safeUp()
    {
        $this->createTable('detail_transaksi', [
            'id' => $this->primaryKey(),
            'trans_id' => $this->integer()->notNull(),
            'goods_id' => $this->integer()->notNull(),
            'qty' => $this->integer()->notNull(),
        ]);
    }
    public function safeDown()
    {
        echo "m221227_041812_addTableDetailTrans cannot be reverted.\n";
        $this->dropTable('detail_transaksi');
        // return false;
    }
}
