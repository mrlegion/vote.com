<?php

use yii\db\Migration;

/**
 * Class m190918_111213_parse_json
 */
class m190918_111213_parse_json extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'text' => $this->string(255)->notNull(),
            'int_id' => $this->string(255)->notNull(),
            'level_id' => $this->integer(5)->notNull(),
            'children' => $this->integer(1)->notNull()->defaultValue(0),
            'parent_id' => $this->integer(11)->notNull()->unsigned(),
        ]);

        $this->addForeignKey('fk_child_to_parent', '{{%address}}', 'parent_id', '{{%address}}', 'id', 'CASCADE', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190918_111213_parse_json cannot be reverted.\n";

        $this->dropForeignKey('fk_child_to_parent', '{{%address}}');
        $this->dropTable('{{%address}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_111213_parse_json cannot be reverted.\n";

        return false;
    }
    */
}
