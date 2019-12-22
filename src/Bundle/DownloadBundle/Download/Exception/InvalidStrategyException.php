<?php

declare(strict_types = 1);

namespace App\Bundle\DownloadBundle\Download\Exception;

use Exception;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class InvalidStrategyException extends Exception
{
    protected $message = 'Please set properly strategy';
}