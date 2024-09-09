<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_image".
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $image
 * @property string|null $title
 * @property string|null $text
 *
 * @property Gallery $gallery
 */
class GalleryImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_id', 'image'], 'required'],
            [['gallery_id'], 'integer'],
            [['text'], 'string'],
            [['image', 'title'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::class, 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'image' => 'Image',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[Gallery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::class, ['id' => 'gallery_id']);
    }
}
