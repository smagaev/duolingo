<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $timer0
 * @property int|null $timer1
 * @property int|null $timer2
 * @property int|null $timer3
 * @property int|null $timer4
 * @property int|null $timer5
 * @property int|null $timer6
 * @property int|null $sourceWords
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'timer1', 'timer2', 'timer3', 'timer4', 'timer5', 'timer6', 'timer7', 'timer8', 'timer9', 'sourceWords', 'show_btn_next', 'mixed_mode', 'mode_of_studies'], 'integer'],
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
            'timer1' => 'Timer1',
            'timer2' => 'Timer2',
            'timer3' => 'Timer3',
            'timer4' => 'Timer4',
            'timer5' => 'Timer5',
            'timer6' => 'Timer6',
            'timer7' => 'Timer7',
            'timer8' => 'Timer8',
            'timer9' => 'Timer9',
            'sourceWords' => Yii::t('app', 'sourceWords'),
            'show_btn_next' => Yii::t('app', 'showButtonNext'),
            'mixed_mode' => Yii::t('app', 'Mixed mode'), /* 0 - no; 1 - mixed mode */
            'mode_of_studies' => Yii::t('app', 'Mode of studies'), /* 0 - reading; 1 - input*/
        ];
    }


    public static function getOption($userId, $option)
    {
        if (!$options = self::find()->where(['user_id' => $userId])->one()) {
            return yii::$app->params[$option];
        } else {
            return $options->$option;
        }
    }
}
