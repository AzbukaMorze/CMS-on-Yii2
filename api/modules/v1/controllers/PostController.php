<?php

namespace api\modules\v1\controllers;

use common\models\Post;
use common\models\PostSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends AppController
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'authentificator' => [
                'except' => ['index', 'view']
            ]
        ]);
    }

    /**
     * Lists all Post models.
     *
     * @return array
     */
    public function actionIndex()
    {
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search([]);

        $pagination = [
            'pageSize' => $queryParams['item_count'] ?? 10,
            'page' => ($queryParams['first_item'] ?? 0) / ($queryParams['item_count'] ?? 10),
        ];

        $dataProvider->pagination->pageSize = $pagination['pageSize'];
        $dataProvider->pagination->page = $pagination['page'];

        $posts = $dataProvider->getModels();


        return [
            'success' => true,
            'posts' => $posts,
            'pagination' => [
                'total_count' => $dataProvider->getTotalCount(),
                'current_page' => $pagination['page'] + 1,
                'page_size' => $pagination['pageSize'],
            ],
        ];
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $post = Post::findOne($id);
        if ($post && $post->status == '10') {
            return [
                'success' => true,
                'data' => [
                    'id' => $post->id,
                    'user_id' => $post->user_id,
                    'category_id' => $post->category_id,
                    'category_name' => $post->category ? $post->category->name : null,
                    'title' => $post->title,
                    'content' => $post->content,
                ],
            ];
        }

        throw new NotFoundHttpException(\Yii::t('app', 'Post not found or not published'));
    }

    /**
     * Creates a new Post model.
     * @return array
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'data' => $model,
            ];
        }

        return [
            'success' => false,
            'errors' => $model->errors,
        ];
    }

    /**
     * Updates an existing Post model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'data' => $model,
            ];
        }

        return [
            'success' => false,
            'errors' => $model->errors,
        ];
    }

    /**
     * Deletes an existing Post model.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return [
                'success' => true,
                'message' => \Yii::t('app', 'Post deleted successfully'),
            ];
        }

        return [
            'success' => false,
            'message' => \Yii::t('app', 'Post deletion failed'),
        ];
    }

    /**
     * Finds the Post model based on its primary key value.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) != null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
