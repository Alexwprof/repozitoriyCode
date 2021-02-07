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
    public $range;
    public $price;
    public $col;
    public $img;
    public function connect($url){
    //Подключение
    $ch = curl_init($url);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36");
    curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
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


    public function connectauth($url,$data,$head){
        //Подключение
        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36");
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt( $ch, CURLOPT_HEADER, true);
        curl_setopt( $ch, CURLOPT_NOBODY, true); //только заголовки
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt ($ch, CURLOPT_HTTPHEADER,$head);
        $this->html = curl_exec($ch);
        curl_setopt($ch, CURLOPT_URL, 'https://kursk.hh.ru/applicant/resumes');
        curl_close( $ch);

        if($this->html === false){
            echo "Произошла оибка в Curl: " . curl_error($ch);

        }
    }



    public function show($selector,$attr){
        $filename = 'qw.txt';
        //Поиск по отдельному селектору
        $str = $this->html;
        $elem = phpQuery::newDocument($str);
        $this->pq = pq($elem);
        $this->text = $this->pq->find($selector);
        file_put_contents($filename, $this->pq,FILE_APPEND);
        foreach ($this->text as $key => $item) {
            $url = pq($item);
            $this->link[] = $_SERVER['HTTP_HOST'] . '/' . $url->attr($attr) . '<br>';

            //Выводим каждую первую запись
            for ($i = 0; $i < 10000; $i++) {
                $this->test = $this->link;
                 array_intersect_key($this->test, array_fill_keys(range(-1, 100, 1), '/'));
                $this->test;
            }
        }
    }
    //Выводить с пагинацией
    public function pagination($url,$start ,$end){
        sleep(1);
        //Получение данных на странице с пагинацией
        if ($start < $end) {
            $file = file_get_contents($url);
            $doc = phpQuery::newDocument($file);
            foreach ($doc->find('.organic__title-wrapper') as $art) {
                $filename = 'qw.txt';
                $art = pq($art);
                // $art->find('.main-sect category-posts-widget')->remove();
                // $img = $art->find('.img-cont img')->attr('src');
                $this->range = $art->find('.organic__url-text')->html();
                echo  $this->range;
                //file_put_contents($filename, $this->range,FILE_APPEND);
                // echo "<img src='$img'>";;
                echo '<hr>';
            }
            $next = 'https://yandex.ru'. $doc->find('.pager .pager__item_current_yes ')->next()->attr('href');
            if (!empty($next)) {
                $start++;
                $this->pagination($next,$start,$end);
            }

        }

    }



public function difitems($url){
    sleep(1);

    //Получение нескольких элементов по селктору

        $file = file_get_contents($url);
        $doc = phpQuery::newDocument($file);
        foreach ($doc->find('.detail-main') as $art) {
            //$filename = 'qw.txt';
            $art = pq($art);
            // $art->find('.main-sect category-posts-widget')->remove();
            // $img = $art->find('.img-cont img')->attr('src');
            $this->price = $art->find('h1')->html();
            $this->range = $art->find('.p-price-content .p-price')->html();
          //  echo  $this->range . '<br>';
            echo  $this->price . '<br>';
            echo  $this->range . '<br>';





            //file_put_contents($filename, $this->range,FILE_APPEND);
            // echo "<img src='$img'>";;

        }

    }







}