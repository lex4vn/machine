<?php
/**
 * Created by PhpStorm.
 * User: MyPC
 * Date: 03/03/2018
 * Time: 2:56 SA
 */
//http://yamatokikai.co.jp/images/_dummy1.jpg
$url = 'http://yamatokikai.co.jp/images/_dummy';
for($i = 1;$i<15;$i++){
    $site = $url . $i.'.jpg';
    $img = $i.'.jpg';
    file_put_contents($img, file_get_contents($site));
}
