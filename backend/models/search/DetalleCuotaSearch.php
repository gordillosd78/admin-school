<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleCuota;

/**
 * DetalleCuotaSearch represents the model behind the search form about `app\models\DetalleCuota`.
 */
class DetalleCuotaSearch extends DetalleCuota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'periodo', 'cantidad', 'cuota_id', 'concepto_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['interes'], 'number'],
            [['observacion', 'created_at', 'updated_at'], 'safe'],
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
    public function search()
    {
        $query = DetalleCuota::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cuota_id' => $this->cuota_id,

        ]);

        return $dataProvider;
    }
}
