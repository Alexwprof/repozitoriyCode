<?php
class Parser{
    public $html;
    public $pq;
    public $text;
    public $href;
    public $attr;
    public $link;
    public $test;
    public $request;
    public function connect($url){
        //Подключение
        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt( $ch, CURLOPT_HEADER, true);
        //curl_setopt( $ch, CURLOPT_NOBODY, true); //только заголовки

        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true);

        $this->html = curl_exec($ch);
        curl_close( $ch);

        if($this->html === false){
            echo "Произошла оибка в Curl: " . curl_error($ch);

        }


    }
    public function show($selector,$attr)
    {
        //Поиск по отдельному селктору
        $str = $this->html;
        $elem = phpQuery::newDocument($str);
        $this->pq = pq($elem);
        $this->text = $this->pq->find($selector);
        foreach ($this->text as $key => $item) {
            $url = pq($item);
            $this->link[] = $_SERVER['HTTP_HOST'] . '/' . $url->attr($attr) . '<br>';

            //Выводим каждую первую запись
            for ($i = 0; $i < 10000; $i++) {
                $this->test = $this->link;
                $this->test = array_intersect_key($this->test, array_fill_keys(range(-1, 100, 1), '/'));


            }

        }

    }

}