<?php
use QL\QueryList;

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/7/19
 * Time: 09:55
 */
class SpiderController
{
    // RSS源
    public function source()
    {
        $memcache = new Memcached();
        $memcache->addServer('localhost', 11211) or die ("Could not connect"); //连接Memcached服务器

        if(!($all = $memcache->get('all'))){
            $url = 'https://docs.rsshub.app';
            // 定义采集规则
            $rules = [
                'title' => ['.sidebar-group-items a', 'text'],
                'link' => ['.sidebar-group-items a', 'href', '', function ($content) use ($url) {
                    return $url . $content;
                }],
            ];

            $list = QueryList::get($url)->rules($rules)->query()->getData()->slice(5);

            $h1 = QueryList::rules([
                'channel-title' => ['h2', 'id']
            ]);

            $h2 = QueryList::rules([
                'sub-title' => ['h3', 'id'],
                'sub-url' => ['h3+div .example a', 'href']
            ]);

            $all = $list->map(function ($item, $index) use ($url, $h1, $h2) {
                $html = QueryList::get($item['link']);

                $htmlStr = $html->getHtml();
                $html->destruct();
                $arr = array_slice(explode('<h2', $htmlStr), 1);

                foreach ($arr as $value) {
                    $channel = [];
                    $s = '<h2' . $value;
                    $channel = $h1->html($s)->query()->getData()->first();

                    $item['sub-list'][$channel['channel-title']] = $h2->html($s)->queryData();
                }

                return $item;
            })->toArray();

            $memcache->set('all',$all);
        }

        if (isset($_REQUEST['channel'])) {
            $channel = getArray($all, $_REQUEST['channel']);
            echo json_encode($channel);
        } else {
            echo json_encode($all);
        }
    }
}