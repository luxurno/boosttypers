<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Converter;

use DateTime;
use Exception;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class DateConverter
{
    /**
     * @param string $link
     * @param string $title
     * @return string|null
     * @throws Exception
     */
    public function convert(string $link, string $title): ?DateTime
    {
        $link = urldecode($link);

        try {
            if (preg_match('/[a-zA-Z]{3,7} \d{4}/', $link, $match)) {
                $date = strtotime($match[0]);
            } elseif (preg_match('/[a-zA-Z]{3,7} \d{4}/', $link, $match)) {
                $date = strtotime($match[0]);
            } elseif (preg_match('/[a-zA-Z]{3,7} \d{4}/', $title, $match)) {
                $date = strtotime($match[0]);
            } elseif (preg_match('/[a-zA-Z]{3,7} \d{2}/', $link, $match)) {
                $date = explode(" ", $match[0]);
                $date[1] = "20".$date[1];
                $date = implode(" ", $date);
                $date = strtotime($date);
            } elseif (preg_match('/[a-zA-Z]{3,7} \d{1,2} \d{4}/', $link, $match)) {
                $date = strtotime($match[0]);
            }
            // Fixing one date interval
            $date = $date + 86400;
            $date = new DateTime("@$date");
        } catch (Exception $e) {
            $date = null;
        }

        return $date;
    }
}
