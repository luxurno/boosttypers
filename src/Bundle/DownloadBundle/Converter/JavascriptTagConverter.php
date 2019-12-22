<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Converter;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class JavascriptTagConverter
{
    /**
     * @param string $url
     * @return string
     */
    public function convert(string $url): ?string
    {
        $url = htmlspecialchars_decode(urldecode($url), ENT_QUOTES);

        if (preg_match("/'[a-zA-Z0-9]{5,20}'/", $url, $match)) {
            return trim($match[0],"'");
        }

        return null;
    }
}
