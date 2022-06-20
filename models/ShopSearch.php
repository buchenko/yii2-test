<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * ShopSearch represents the model behind the search form of `app\models\Shop`.
 */
class ShopSearch extends Shop
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['first_name', 'last_name', 'phone', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Shop::find();

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
            'id' => $this->id,
        ]);

        if ($this->created_at) {
            $query->andWhere(['between', 'created_at', strtotime($this->created_at . ' 00:00:00'), strtotime($this->created_at . ' 23:59:59') ]);
        }
        if ($this->updated_at) {
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at . ' 00:00:00'), strtotime($this->updated_at . ' 23:59:59') ]);
        }

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
