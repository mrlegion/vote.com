<?php

use yii\db\Migration;

/**
 * Class m190910_101635_init
 */
class m190910_101635_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(13)->notNull(),
            'email' => $this->string(255)->notNull(),
            'birthday' => $this->date()->notNull(),
            'state' => $this->string(100)->notNull(),
            'city' => $this->string(100)->notNull(),
            'street' => $this->string(100)->notNull(),
            'home' => $this->string(20)->notNull(),
        ]);

        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(11),
            'username' => $this->string(50)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'access_token' => $this->string(255)->notNull(),
            'email' => $this->string(100)->null(),
            'is_blocked' => $this->integer(1)->notNull()->defaultValue(0),
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
        ]);

        $this->createTable('{{%vote}}', [
            'id'    => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'ratio' => $this->integer(2)->notNull(),
            'text'  => $this->text(),
        ]);

        $this->addForeignKey('{{%fk_vote_user}}', '{{%vote}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190910_101635_init cannot be reverted.\n";

        $this->dropForeignKey('{{%fk_vote_user}}', '{{%vote}}');
        $this->dropTable('{{%vote}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%admin}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190910_101635_init cannot be reverted.\n";

        return false;
    }
    */
}
