<?php

namespace app\models;

use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    const STATUS_LIST = [
        self::STATUS_NEW => 'New',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected',
    ];

    public static function tableName() {
        return "{{%comments}}";
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class
            ]
        ];
    }

    public function beforeSave($insert)
    {
        $request = \Yii::$app->request;
        $this->user_agent = $request->userAgent;
        $this->ip = $request->userIP;

        return parent::beforeSave($insert);
    }

    public function rules() {
        return [
            [['username', 'ip', 'user_agent'], 'string', 'max' => 255],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['entity_id', 'status'], 'integer'],
            [['comment', 'entity_id'], 'required'],
            [['status'], 'default', 'value' => self::STATUS_NEW]

        ];
    }

    public function fields()
    {
        return [
            'subject' => function() {return $this->entity->title;},
            'subject_id' => 'entity_id',
            'username',
            'created_at',
            'comment'
        ];
    }

    public function getEntity() {
        return $this->hasOne(Entity::class, ['id' => 'entity_id']);
    }

    public function getStatusName() {
        return self::STATUS_LIST[$this->status];
    }
}