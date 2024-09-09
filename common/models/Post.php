<?php

namespace common\models;

use common\models\User;
use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

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
class Post extends ActiveRecord
{
    public ?UploadedFile $file = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
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
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,svg']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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

    public function beforeValidate(): bool
    {
        $this->file = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }


    /**
     * @throws Exception
     */
    public function afterValidate(): void
    {
        // Проверяем, что файл загружен
        if ($this->file instanceof \yii\web\UploadedFile) {
            // Если у сущности уже есть загруженное изображение, удаляем его
            if (!empty($this->image)) {
                $oldFilePath = Yii::getAlias('@root/htdocs/uploads/') . $this->image;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Генерируем новое имя файла
            $newFileName = Yii::$app->security->generateRandomString() . '.' . $this->file->extension;
            $newFilePath = Yii::getAlias('@root/htdocs/uploads/') . $newFileName;

            // Сохраняем новый файл
            if ($this->file->saveAs($newFilePath)) {
                $this->image = '/uploads/' . $newFileName;
            } else {
                $this->addError('image', 'Не удалось сохранить файл.');
            }
        }

        parent::afterValidate();
    }



    public function getPostCategory(): ActiveQuery
    {
        return $this->hasOne(PostCategory::class, ['id' => 'post_category_id']);
    }

    public function getPostCategoryName(): string
    {
        return $this->postCategory ? $this->postCategory->name : 'Unknown';
    }


    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
