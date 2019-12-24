<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Manipulator;

use App\Bundle\DownloadBundle\Manipulator\PhotoManipulator;

class PhotoManipulatorTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testConvertingPhotos(string $expected, string $href): void
    {
        $photoManipulator = new PhotoManipulator();

        $converted = $photoManipulator->manipulate($href);
        $this->assertEquals($expected, $converted);
    }

    public function provider(): array
    {
        return [
            [
                'wl-15110422301500.jpg',
                'myImage[0] = \'wl-15110422301500.jpg\'',
            ],
            [
                'wl-1eert5y6u6y420.jpg',
                'myImage[3] = \'wl-1eert5y6u6y420.jpg\'',
            ],
        ];
    }
}