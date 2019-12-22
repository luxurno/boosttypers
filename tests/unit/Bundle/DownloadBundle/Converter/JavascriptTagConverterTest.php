<?php

declare(strict_types = 1);

namespace Tests\unit\Bundle\DownloadBundle\Converter;

use App\Bundle\DownloadBundle\Converter\JavascriptTagConverter;

class JavascriptTagConverterTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testDateGeneration(string $link): void
    {

    }

    public function provider(): array
    {
        return [
            [
                'http://www.watchthedeer.com/javascript%3A__doPostBack%28%26%2339%3BbtnNGBear%26%2339%3B%2C%26%2339%3B%26%2339%3B%29',
                'btnNGBear'
            ],
        ];
    }
}