<?php

namespace jakharbek\users\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use jakharbek\users\models\Tokens;

/**
 * TokensSearch represents the model behind the search form of `jakharbek\users\models\Tokens`.
 */
class TokensSearch extends Tokens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_id', 'user_id', 'type', 'status'], 'integer'],
            [['token', 'expire'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tokens::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'token_id' => $this->token_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'expire' => $this->expire,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['ilike', 'token', $this->token]);

        return $dataProvider;
    }
}
