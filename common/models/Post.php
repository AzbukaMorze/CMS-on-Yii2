<?php

namespace common\models;

use admin\models\User;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id ID Пользователя, создавшего пост
 * @property string $title Заголовок
 * @property string $text Текст
 * @property int $post_category_id ID категории
 * @property int $status Статус публикации: brandnew / published / rejected
 * @property string|null $image Изображение (можно хранить строку с путем до изображения)
 * @property int|null $created_at Дата создания
 * @property int|null $updated_at Дата изменения
 *
 * @property PostCategory $postCategory
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'text', 'post_category_id', 'status'], 'required'],
            [['user_id', 'post_category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['text'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::class, 'targetAttribute' => ['post_category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'post_category_id' => Yii::t('app', 'Post Category ID'),
            'status' => Yii::t('app', 'Status'),
            'image' => Yii::t('app', 'Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * Gets query for [[PostCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::class, ['id' => 'post_category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
