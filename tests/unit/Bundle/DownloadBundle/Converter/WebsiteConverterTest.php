<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Converter;


use App\Bundle\DownloadBundle\Converter\WebsiteConverter;

class WebsiteConverterTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testConvertingPhotos(string $expected, string $website, string $href): void
    {
        $photoConverter = new WebsiteConverter();

        $converted = $photoConverter->convert($website, $href);
        $this->assertEquals($expected, $converted);
    }

    public function provider(): array
    {
        return [
            [
                'http://www.watchthedeer.com/looping_images/Nov%202017%20Ga%20Kudzu%20Buck/viewer.aspx',
                'http://www.watchthedeer.com/photos',
                'looping_images/Nov%202017%20Ga%20Kudzu%20Buck/viewer.aspx',
            ],
            [
                'http://www.watchthedeer.com/looping_images/June_2018_Fawn/viewer.aspx',
                'http://www.watchthedeer.com/photos',
                '../looping_images/June_2018_Fawn/viewer.aspx',
            ],
            [
                'http://www.watchthedeer.com/looping_images/Feb%202016-b%20hogs/viewer.aspx',
                'http://www.watchthedeer.com/photos',
                '../looping_images/Feb 2016-b hogs/viewer.aspx',
            ],
        ];
    }
}