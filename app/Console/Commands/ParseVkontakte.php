<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\PhotoType;
use App\Models\Photo;

class ParseVkontakte extends Command
{
    private $hashtag = 'world';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:vkontakte';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse vkontakte feed by hashtag';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->makeRequest('newsfeed.search', [
            'q' => '#'.$this->hashtag,
            'extended' => 0,
            'count' => 20
        ]);

        $is_first = true;
        foreach ($data as $item) {
            if ($is_first) {
                $is_first = false;
                continue;
            }

            if (!isset($item['attachments']) || !$item['attachments'] ||
                !is_array($item['attachments']) ||
                count($item['attachments']) < 1) {
                continue;
            }

            $photo = '';
            foreach ($item['attachments'] as $attachment) {
                if ($attachment['type'] != 'photo') continue;
                if (isset($attachment['photo']) && isset($attachment['photo']['src_xbig'])) {
                    $photo = $attachment['photo']['src_xbig'];
                    break;
                }
            }

            if ($photo == '') continue;

            $object_id = (string) $item['id'];

            $object = [
                'object_id' => $object_id,
                'name' => (string)$photo,
                'type' => PhotoType::VK,
                'text' => (string)$item['text']
            ];

            $photo = Photo::where('object_id', $object_id)->first();
            if (!$photo) {
                Photo::create($object);
            }

            $this->info('Vkontakte object ' . $object_id . ' parsed.');
        }

        $this->info('Vkontakte parsed by #'.$this->hashtag.'!');
    }

    private function makeRequest($name, $options = false) {
        $url = 'https://api.vk.com/method/'.$name;
        if ($options) {
            $url .= '?'.http_build_query($options);
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        if (!$data) $data = [];
        if (!isset($data['response'])) $data['response'] = [];
        if (!is_array($data['response'])) $data['response'] = [];

        return $data['response'];
    }
}
