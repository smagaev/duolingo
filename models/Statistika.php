<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistika".
 *
 * @property int|null $id
 * @property int $user_id
 * @property string|null $data
 * @property int|null $quantity
 */
class Statistika extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statistika';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'quantity'], 'integer'],
            [['user_id'], 'required'],
            [['data'], 'safe'],
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
            'data' => 'Data',
            'quantity' => 'Quantity',
        ];
    }
}
