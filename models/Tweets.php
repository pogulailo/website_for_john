<?php


namespace app\models;

use yii\base\Model;
use linslin\yii2\curl;

class Tweets extends Model
{
    /**
     * Send request to Twitter API.
     *
     * @param $url
     * @return mixed
     * @throws \Exception
     */
    private function twitterApiRequest($url)
    {
        $curl = new curl\Curl();
        $token = \Yii::$app->params['twitterBearerToken'];
        $auth = array('Authorization: Bearer ' . $token);

        $response = $curl
            ->setOption(CURLOPT_HTTPHEADER, $auth)
            ->get($url);

        return json_decode($response);
    }

    /**
     * Get user tweets by user id
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function getLastTweetsByUserId($id)
    {
        $url = 'https://api.twitter.com/labs/2/tweets?ids=%d&tweet';
        $url = sprintf($url, $id);

        return $this->twitterApiRequest($url);
    }

    /**
     * Get user ID by name
     *
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function getUserIdByName($name)
    {
        $url = 'https://api.twitter.com/1.1/users/show.json?screen_name=%s';
        sprintf($url, $name);

        return $this->twitterApiRequest($url);
    }
}