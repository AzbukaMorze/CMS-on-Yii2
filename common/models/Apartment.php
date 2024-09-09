<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apartment".
 *
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string|null $description
 * @property float $price
 * @property int $floor
 * @property string|null $image
 * @property string|null $address
 * @property string|null $additional_title
 * @property int $availability
 *
 * @property Room[] $rooms
 */
class Apartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'floor', 'availability'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['floor', 'availability'], 'integer'],
            [['title', 'subtitle', 'image', 'address', 'additional_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'price' => 'Price',
            'floor' => 'Floor',
            'image' => 'Image',
            'address' => 'Address',
            'additional_title' => 'Additional Title',
            'availability' => 'Availability',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::class, ['apartment_id' => 'id']);
    }
}
