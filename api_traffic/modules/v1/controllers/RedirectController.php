<?php
namespace api_traffic\modules\v1\controllers;

use Yii;

use api_traffic\modules\v1\logics\redirect\domain\RedirectModel;

class RedirectController extends BaseController
{
    public $modelClass = 'app_traffic\modules\v1\logics\redirect\domain\RedirectModel';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => RedirectModel::className(),
                'prepareDataProvider' => function () {
                    return (new RedirectModel())->search(Yii::$app->request->queryParams);
                },
            ],
        ]);
    }
}