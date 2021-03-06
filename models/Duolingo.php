<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "duolingo".
 *
 * @property int $id
 * @property string $word
 * @property string $count_words
 * @property string $var1
 * @property string $var2
 * @property string $var3
 * @property string $var4
 * @property string $var5
 * @property string $var6
 * @property string $user_id
 */
class Duolingo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'duolingo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word', 'var1', 'count_words'], 'required'],
            [['word', 'var1', 'var2', 'var3', 'var4', 'var5', 'var6'], 'string', 'max' => 128],
            [['count_words', 'user_id'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Word',
            'var1' => 'Var1',
            'var2' => 'Var2',
            'var3' => 'Var3',
            'var4' => 'Var4',
            'var5' => 'Var5',
            'var6' => 'Var6',
            'user_id' => 'UserID'
        ];
    }
}
