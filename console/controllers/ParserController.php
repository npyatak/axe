<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use Google\Cloud\Translate\TranslateClient;

use common\models\User;
use common\models\Challenge;

class ParserController extends Controller {

	// public function actionVk($hashtag = 'house', $time = 1800) {
 //        $url = 'https://api.vk.com/method/newsfeed.search';
 //        $start_time = time() - $time;

 //        $params = [
 //            'q' => $hashtag,
 //            'extended' => 1,
 //            //'count' => 3,
 //            //'params[start_from]' => '6%2F-65395224_8404',
 //            'start_time' => $start_time,
 //            'fields' => 'profiles%20',
 //            'v' => 5.69,
 //            'access_token' => 'af918e5daf918e5daf918e5d25aff1911caaf91af918e5df5a2130d3e85b32a77eea3d4',
 //        ];

 //        $postParams = [];
 //        foreach ($params as $key => $value) {
 //            $postParams[] = $key.'='.$value; 
 //        }
 //        $url = $url.'?'.implode('&', $postParams);

 //        $res = file_get_contents($url);

 //        $res = json_decode($res);
 //        $items = $res->response->items;
 //        $profiles = $res->response->profiles;
 //        $totalCount = $res->response->total_count;
 //        $newChallenges = 0;

 //        if(count($items) > 0) {
 //            foreach ($items as $key => $item) {
 //                if(isset($item->attachments)) {
 //                    foreach ($item->attachments as $attachment) {
 //                        if($attachment->type == 'video') {
 //                            print_r($attachment->video);
 //                            $newChallenges++;

 //                            $challenge->vk_owner_id = $attachment->video->owner_id;
 //                            $challenge->video_id = $attachment->video->id;
 //                            $attachment->video->access_key;
 //                            $res = file_get_contents($url);
 //                            print_r($res);
 //                            print_r($url);

 //                            $challenge = new Challenge;

 //                            $challenge->soc = Challenge::SOC_VK;
 //                            $challenge->platform = isset($attachment->video->platform) ? $attachment->video->platform : null;
 //                            $challenge->access_key = $attachment->video->access_key;

 //                            $sizes = ['photo_800', 'photo_640', 'photo_320', 'photo_160'];
 //                            foreach ($sizes as $size) {
 //                                if(isset($attachment->video->$size)) {
 //                                    $challenge->image = $attachment->video->$size;
 //                                    break;
 //                                }
 //                            }

 //                            if(isset($profiles[$key])) {
 //                                $challenge->name = $profiles[$key]->first_name.' '.$profiles[$key]->last_name;
 //                            }

 //                            if(Challenge::find()->where(['access_key' => $challenge->access_key, 'platform' => $challenge->platform])->one() === null) {
 //                                $challenge->save();
 //                            } 
 //                        }
 //                    }
 //                }
 //            }
 //        }
    
 //        Yii::info('VK parse '.$hashtag.'. New rows - '.$totalCount.'. Added videos: '.$newChallenges, 'parser');
 //    }

    public function actionYoutube($hashtag = 'cat', $time = 1800) {
        $youtube = new \Google_Service_YouTube(\Yii::$app->googleApi->client);
        

        //1970-01-01T00:00:00Z
        $publishedAfter = date('Y-m-d', time() - $time).'T09:00:00Z';

        //print_r($publishedAfter);exit;
        $newChallenges = 0;
        try {
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'q' => $hashtag,
                'publishedAfter' => $publishedAfter,
                'type' => 'video',
            ));

            foreach ($searchResponse['items'] as $item) {
                print_r($item);
                $challenge = new Challenge;
                $newChallenges++;

                $challenge->soc = Challenge::SOC_YOUTUBE;
                //$challenge->platform = isset($attachment->video->platform) ? $attachment->video->platform : null;
                $challenge->access_key = $item['id']['videoId'];

                $challenge->image = $item['snippet']['thumbnails']['high']['url'];
                $challenge->name = $item['snippet']['channelTitle'];

                if(Challenge::find()->where(['access_key' => $challenge->access_key])->one() === null) {
                    $challenge->save();
                } 

                Yii::info('Youtube parse '.$hashtag.'. Added videos: '.$newChallenges, 'parser');

                print_r($challenge->getErrors());
            }
        } catch (Google_Service_Exception $e) {
            Yii::info('Youtube parse: '.$e->getMessage());
        } catch (Google_Exception $e) {
            Yii::info('Youtube parse: '.$e->getMessage());
        }
    }
}