<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cuota;

/**
 * CuotaSearch represents the model behind the search form about `app\models\Cuota`.
 */
class CuotaSearch extends Cuota
{
    public $fechaDesde;
    public $fechaHasta;
    public $rows = 30;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'alumno_id', 'estado', 'created_by', 'updated_by'], 'integer'],
            [['fecha', 'vencimiento', 'observacion', 'created_at', 'updated_at'], 'safe'],
            [['total'], 'number'],
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
        $query = Cuota::find();

        // add conditions that should always apply here
        $query->andFilterWhere(['alumno_id' => $this->alumno_id]);
        $query->andFilterWhere(['estado' => $this->estado]);

        $desde = $this->setFecha($this->fechaDesde);
        $hasta = $this->setFecha($this->fechaHasta);

        if (!empty($this->fechaDesde) && empty($this->fechaHasta)) {
            $query->andFilterWhere(['>=', 'fecha', $desde]);
        } elseif (empty($this->fechaDesde) && !empty($this->fechaHasta)) {
            $query->andFilterWhere(['<=', 'fecha', $hasta]);
        } elseif (!empty($this->fechaDesde) && !empty($this->fechaHasta)) {
            $query->andFilterWhere(['between', 'fecha', $desde, $hasta]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->rows,
            ],
        ]);

        $query->orderBy([
            'id' => SORT_DESC,
        ]);

        return $dataProvider;
    }
}
