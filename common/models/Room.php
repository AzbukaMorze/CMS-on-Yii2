<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $apartment_id
 * @property string $name
 * @property float $area
 * @property string $uid
 * @property string|null $additional_image
 * @property int $availability
 *
 * @property Apartment $apartment
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apartment_id', 'name', 'area', 'uid', 'availability'], 'required'],
            [['apartment_id', 'availability'], 'integer'],
            [['area'], 'number'],
            [['name', 'uid', 'additional_image'], 'string', 'max' => 255],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::class, 'targetAttribute' => ['apartment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apartment_id' => 'Apartment ID',
            'name' => 'Name',
            'area' => 'Area',
            'uid' => 'Uid',
            'additional_image' => 'Additional Image',
            'availability' => 'Availability',
        ];
    }

    /**
     * Gets query for [[Apartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApartment()
    {
        return $this->hasOne(Apartment::class, ['id' => 'apartment_id']);
    }
}
