<?php

use yii\db\Migration;

/**
 * Class m200416_190329_field
 */
class m200416_190329_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sudoku', [
            'id' => $this->primaryKey(),
            'field' => $this->json(),
            'finish' => $this->boolean()->notNull()->defaultValue(0),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sudoku');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_190329_field cannot be reverted.\n";

        return false;
    }
    */
}
