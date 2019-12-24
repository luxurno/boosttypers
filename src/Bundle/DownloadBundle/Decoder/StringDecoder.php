<?php

declare(strict_types=1);

namespace App\Bundle\DownloadBundle\Decoder;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class StringDecoder
{
    public function decode(array &$array)
    {
        array_walk_recursive(
            $array,
            function (&$url) {
                if (!is_object($url)) {
                    $url = html_entity_decode(htmlspecialchars_decode(rawurldecode($url), ENT_QUOTES));
                }
            });
    }
}