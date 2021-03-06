<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "helpdesk".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $commetnt
 * @property integer $status
 * @property string $date
 * @property string $sotrud
 * @property string $date_end
 */
class Helpdesk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helpdesk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commetnt'], 'required'],
            [['id_user', 'status'], 'integer'],
            ['id_user', 'default', 'value' => Yii::$app->user->getId()],
            ['status', 'default', 'value' => 0],
            [['commetnt'], 'string'],
            [['date', 'endDate'], 'safe'],
            [['sotrud'], 'string', 'max' => 50],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Магазин',
            'commetnt' => 'Описание',
            'status' => 'Статсус',
            'date' => 'Дата',
            'sotrud' => 'Имя сотрудника',
            'dateEnd' => 'Date_end',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
