<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Transformer;

use Exception;
use PHPHtmlParser\Dom;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class ContentPhotoTransformer
{
    /**
     * 
     * @param Dom $dom
     */
    public function transform(Dom $dom): void
    {
        $photos = $dom->find("img",0);
        
        var_dump($photos);
        echo "<br/><br/>";
        die;
        
        
        try {
            $photos = $dom->find("title",0)->innertext;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
        if (!empty($photos)) {
            var_dump($photos);
        }
        
        print_r($dom);
        die;
        
        
        foreach ($photos as $photo) {
            var_dump(htmlentities($photo->plaintext));
        }
        echo "<br/><br/>";
        echo "Transformuje!";
        echo "<br/><br/>";
            die;
        
        
        
        
//        if (isset($photos)) {
//            echo "Photos";
//            var_dump($photos);
//        }
//        echo "<br/><br/>";
        
        //print_r($dom);
        
        echo "<br/><br/>";
        echo "Transformuje!";
        
        die;
        
    }
    
}
