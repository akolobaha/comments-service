<?php

namespace app\models\search;

use app\models\Comment;
use yii\data\ActiveDataProvider;

class CommentSearch extends Comment
{
    public $username;
    public $comment;
    public $status;
    public $entity_id;
    public $entity_title;

    public function rules()
    {
        return [
            [['id', 'entity_id'], 'integer'],
            [['username', 'comment', 'status', 'entity_title'], 'string'],
            [['username', 'comment', 'status'], 'safe'],
        ];
    }


    public function search($params)
    {
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $query->andFilterWhere([
            'entity_id' => $this->entity_id,
        ]);


        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }


}