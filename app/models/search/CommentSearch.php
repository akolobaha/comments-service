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

    public function rules()
    {
        return [
            [['username', 'comment', 'status', 'created_at', 'entity_id', 'entity_title', 'id'], 'safe']
        ];
    }


    public function search($params)
    {
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]

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

        if ($this->created_at) {
            $start_timestamp = strtotime($this->created_at);
            $finish_timestamp = strtotime('+1 day', $start_timestamp) - 1;
            $query->andFilterWhere(['between', 'created_at', $start_timestamp, $finish_timestamp]);
        }

        $query->andFilterWhere(['like', 'username', $this->username]);
        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }


}