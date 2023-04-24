<?php
namespace app\commands;

use app\models\Comment;
use app\models\Entity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use phpQuery;
use yii\console\Controller;
use yii\helpers\Console;

class ParserController extends Controller
{
    const URLS_OTZOVIK = [
        'https://otzovik.com/reviews/smartphone_apple_iphone_14_pro_max/',
//        'https://otzovik.com/reviews/sberbank_rossii/'
    ];

    public function actionOtzovik() {
        foreach (self::URLS_OTZOVIK as $url) {
            $client = new Client();

            try {
                $res = $client->request('GET', $url);
                $html = (string) $res->getBody();

                $doc = phpQuery::newDocument($html);
                $product_title =  $doc->find('h1.product-name > span')->text();
                $entity_id = Entity::getByTitle($product_title);

                $data_to_save = [];
                $doc->find('div.item.status4.mshow0')->each(
                    function($item) use (&$data_to_save, $entity_id) {
                        $username = pq($item)->find('a.user-login > span')->text();
                        $plus = pq($item)->find('div.review-plus')->text();
                        $minus = pq($item)->find('div.review-minus')->text();
                        $teaser = pq($item)->find('div.review-teaser')->text();

                        $data_to_save [] = [
                            'username' => $username,
                            'comment' => "{$plus}\n{$minus}\n{$teaser}",
                            'entity_id' => $entity_id,
                            'status' => Comment::STATUS_NEW,
                            'created_at' => time(),
                            'updated_at' => time(),
                        ];
                    }
                );

                \Yii::$app->db->createCommand()->batchInsert('comments', [
                    'username', 'comment', 'entity_id', 'status', 'created_at', 'updated_at'
                ], $data_to_save)->execute();

                $this->stdout("{$product_title} успешно спарсили!\n", Console::FG_GREEN);

                sleep(5);
            } catch (ServerException $e) {
                $this->stdout("Поймали каптчу на странице {$url}\n", Console::FG_RED);
            }
        }
    }
}