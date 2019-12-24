<?php

declare(strict_types = 1);

namespace Tests\unit\Bundle\DownloadBundle\Converter;

use App\Bundle\DownloadBundle\Converter\JavascriptTagConverter;

class JavascriptTagConverterTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testDateGeneration(string $link, string $parsed): void
    {
        $javascriptTagConverter = new JavascriptTagConverter();
        $this->assertEquals($parsed, $javascriptTagConverter->convert($link));
    }

    public function provider(): array
    {
        return [
            [
                'http://www.watchthedeer.com/javascript%3A__doPostBack%28%26%2339%3BbtnNGBear%26%2339%3B%2C%26%2339%3B%26%2339%3B%29',
                'btnNGBear',
            ],
            [
                'javascript:__doPostBack(&#39;btnDoes1016&#39;,&#39;&#39;)',
                'btnDoes1016',
            ],
            [
                'javascript:__doPostBack(&#39;btnJuly18Buck&#39;,&#39;&#39;)',
                'btnJuly18Buck',
            ],
            [
                'javascript:__doPostBack(&#39;btnNGBear&#39;,&#39;&#39;)',
                'btnNGBear',
            ],
            [
                'javascript:__doPostBack(&#39;btnTwinFawns&#39;,&#39;&#39;)',
                'btnTwinFawns',
            ],
            [
                'javascript:__doPostBack(\'btnTwinsAgain\',\'\')',
                'btnTwinsAgain',
            ],
        ];
    }
}