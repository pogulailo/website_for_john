<?php


namespace app\controllers;

use yii\rest\ActiveController;
use app\models\Tweets;
use app\models\Persons;

class PersonsController extends ActiveController
{
    public $modelClass = 'app\models\Persons';

    public function actionAddPerson()
    {
        $tweetsModel = new Tweets();

        $request = \Yii::$app->request;

        if ($request->isPost) {
            $request = $request->post();

            $user_name = $request['user_name'];

            $user_id = $tweetsModel->getUserIdByName($user_name);
            $user_id = $user_id['user_id'];

            // Add user into DB
            $persons = new Persons();
            $persons->user_id = $user_id;
            $persons->user_name = $user_name;
            $persons->save();
        }
    }

    /**
     * Get latest tweets of user by user ID
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function actionTweetsById($id)
    {
        $tweetsModel = new Tweets();

        $query = Persons::find();
        $result = $query->select(['user_name'])->where(['id' => $id])->one();
        $user_name = $result['user_name'];

        return $tweetsModel->getLastTweetsByUserId($user_name);
    }

    public function actionAllTweets()
    {
        $tweetsModel = new Tweets();

        $query = Persons::find();
        $users_id = $query->select(['user_id']);

        $tweets_list = array();

        foreach ($users_id as $id) {
            $tweets_list[] = $tweetsModel->getLastTweetsByUserId($id);
        }

        return $tweets_list;
    }
}