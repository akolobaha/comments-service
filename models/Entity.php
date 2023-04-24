<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property $title
 * @property $id
 */
class Entity extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%entities}}";
    }

    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255]
        ];
    }

    static function getTitlesList() {
        $arr = Entity::find()->select(['id', 'title'])->asArray()->all();
        $mapped_arr = ArrayHelper::map($arr, 'id', 'title');
        foreach ($mapped_arr as $index => $item)
            $mapped_arr[$index] .= " (id: $index)";

        return $mapped_arr;
    }

    static function getIdsList() {
        $arr = Entity::find()->select(['id'])->asArray()->all();
        return ArrayHelper::map($arr, 'id', 'id');
    }

    /**
     * @param $title
     * @return false|int|string
     * get or create by title
     */
    public static function getByTitle($title) {
        $existing_id = self::find()
            ->where(['title' => $title])
            ->select('id')
            ->scalar();

        if ($existing_id)
            return $existing_id;

        $model = new self();
        $model->title = $title;

        if ($model->save())
            return $model->id;

        return false;
    }
}