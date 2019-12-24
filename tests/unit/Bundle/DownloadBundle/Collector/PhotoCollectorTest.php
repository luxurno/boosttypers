<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Collector;

use App\Bundle\DownloadBundle\Collector\PhotoCollector;

class PhotoCollectorTest extends \Codeception\Test\Unit
{
    public function testCollectMethodOnNotFoundCharacter(): void
    {
        $photoCollector = new PhotoCollector();
        $notMatched = 'some-test-without separator-character';
        $this->assertEquals([$notMatched], $photoCollector->collect($notMatched));
    }

    public function testCollectMethodOnFoundCharacter(): void
    {
        $photoCollector = new PhotoCollector();
        $matched = 'some-test-with;separator-character';
        $matchedArray = ['some-test-with', 'separator-character'];
        $this->assertEquals($matchedArray, $photoCollector->collect($matched));
    }

}