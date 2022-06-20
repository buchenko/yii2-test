<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product[] $products
 */
class Category extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'categories';
    }

    /**
     * @return string[]
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return ActiveQuery
     */
    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function beforeDelete(): bool
    {
        if (count($this->products)){
            Yii::$app->session->addFlash('error','Unable to delete product category.');

            return false;
        }
        return parent::beforeDelete();
    }
}
