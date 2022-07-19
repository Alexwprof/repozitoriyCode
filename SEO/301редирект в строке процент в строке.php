
<?
     /** /gjjhfh%    **/
    $re2 = '/^\/(.+%)/m';
    preg_match_all($re2, $_SERVER["REQUEST_URI"], $matches2, PREG_SET_ORDER, 0);
    if(!empty($matches2)){header('Location: /',true, 301);}
    
    /** /arenda/gjjhfh%    **/
    $re = '/^\/(arenda)\/(.+%)/m';
    preg_match_all($re, $_SERVER["REQUEST_URI"], $matches, PREG_SET_ORDER, 0);
    if(!empty($matches)){header('Location: /arenda/',true, 301);}


?>
