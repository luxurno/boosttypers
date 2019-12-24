<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Converter;

use App\Bundle\DownloadBundle\Converter\PhotoConverter;

class PhotoConverterTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testConvertingPhotos(string $expected, string $website, string $href): void
    {
        $photoConverter = new PhotoConverter();

        $converted = $photoConverter->convert($website, $href);
        $this->assertEquals($expected, $converted);
    }

    public function provider(): array
    {
        return [
            [
                'http://www.watchthedeer.com/looping_images/June_2018_Fawn',
                'http://www.watchthedeer.com/viewer.aspx',
                'looping_images/June_2018_Fawn',
            ],
        ];
    }
}