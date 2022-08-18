<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verbs".
 *
 * @property int $id
 * @property string|null $form1
 * @property string|null $form2
 * @property string|null $form3
 * @property string|null $meaning
 */
class Verbs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verbs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form1', 'form2', 'form3', 'meaning'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form1' => Yii::t('app','Infinitive'),
            'form2' => Yii::t('app','PastSimple'),
            'form3' => Yii::t('app','Participle'),
            'meaning' => 'Translate',
        ];
    }
}
