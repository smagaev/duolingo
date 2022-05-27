<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exclude".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $word_id
 * @property int|null $time
 */
class Exclude extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exclude';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'word_id', 'time'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'word_id' => 'Word ID',
            'time' => 'Time',
        ];
    }
}
