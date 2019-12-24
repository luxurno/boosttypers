<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Converter;

use App\Bundle\DownloadBundle\Converter\VideoConverter;

class VideoConverterTest extends \Codeception\Test\Unit
{

    /**
     * @dataProvider provider
     */
    public function testConvertingPhotos(string $expected, string $website, string $href): void
    {
        $photoConverter = new VideoConverter();

        $converted = $photoConverter->convert($website, $href);
        $this->assertEquals($expected, $converted);
    }

    public function provider(): array
    {
        return [
            [
                'http://www.watchthedeer.com/Video/Feeder.20161026_000838_1.mp4',
                'http://www.watchthedeer.com/Video/Viewer',
                'Feeder.20161026_000838_1.mp4',
            ],
        ];
    }
}