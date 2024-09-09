<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $key
 * @property string $group
 * @property string $article
 * @property string|null $comment
 * @property int $deletable
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'group', 'article'], 'required'],
            [['article'], 'string'],
            [['deletable'], 'integer'],
            [['key', 'group', 'comment'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'group' => 'Group',
            'article' => 'Article',
            'comment' => 'Comment',
            'deletable' => 'Deletable',
        ];
    }
}
