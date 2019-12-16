<?php

namespace App\Controller;

use PHPHtmlParser\Dom;

require '../../old_project/simple_html_dom.php';

class TestController
{
    public function testDownload()
    {
        $url = "http://www.watchthedeer.com/looping_images/Abilene%20Sept%202015/viewer.aspx";

        // It works
        $html = file_get_html($url);

        try {
            $photos = $html->find("head script",0)->innertext;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
        var_dump($photos);
        
        die;
    }
}
