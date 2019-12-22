<?php

declare(strict_types = 1);

namespace Tests\unit\Bundle\DownloadBundle\Converter;

use App\Bundle\DownloadBundle\Converter\DateConverter;

class DateConverterTest extends \Codeception\Test\Unit
{
    /**
     * @dataProvider provider
     */
    public function testDateGeneration(string $link, string $title, string $date): void
    {
        $dataConverter = new DateConverter();

        $dateReturned = $dataConverter->convert($link, $title);
        $dateReturned = $dateReturned->format('Y-m-d');
        $this->assertEquals($date, $dateReturned);
    }

    public function provider(): array
    {
        return [
            [
                '../looping_images/Fawn Release August 2015 Texas-IMG_0088.MOV',
                'Fawn Release from Fence- Texas full video',
                '2015-08-01',
            ],
            [
                '../looping_images/Abilene Sept 2015/viewer.aspx',
                'Exotic Animals (300 images) - Texas',
                '2015-09-01',
            ],
            [
                '../looping_images/Nov 15- Georgia-Resting spike buck/viewer.aspx',
                'Lazy Georgia Spike Buck resting by the Feeder (333 pics)',
                '2015-11-01',
            ],
            [
                '../looping_images/Minnesota eagles and turkey buzzards Oct 2015/viewer.aspx',
                'Minnesota Eagles and Turkey Buzzards Oct 2015 (21 pictures)',
                '2015-10-01',
            ],
            [
                '../looping_images/Dec-15-North Ga Tube Buck/viewer.aspx',
                'North Ga buck feeding  (216 Images) Dec 2015',
                '2015-12-01',
            ],
            [
                '../looping_images/Nov -15-Virginia Bears Again/viewer.aspx',
                'Thanksgiving Virginia Bears Nov 2015 (42 images)',
                '2015-11-01',
            ],
            [
                '../looping_images/Feb 2016-b hogs/viewer.aspx',
                'Wild Hogs enjoying themselves. I hate Hogs. (225 images)',
                '2016-02-01',
            ],
            [
                '../looping_images/July 2016 Bear Pics/viewer.aspx',
                'Virginia Bear Sow and her two Cubs (27 images)  July 2016',
                '2016-07-01',
            ],
            [
                '../looping_images/July 16 - late-Mother Does and four fawns/viewer.aspx',
                'Mother Does and their Fawns- Four! (260 images)',
                '2016-07-01',
            ],
            [
                '../looping_images/Aug 16 Virginia-Bear checks out box/viewer.aspx',
                'August 2016 - Bear wants in (255 images)',
                '2016-08-01',
            ],
            [
                '../looping_images/Sept-2016-Virginia Bucks/viewer.aspx',
                'Sept 2016 Virginia Bucks (40 images)',
                '2016-09-01',
            ],
            [
                '../looping_images/North Georgia Buck Mid Dec 2016/viewer.aspx',
                'December 2016 North Georgia Buck (46 images)',
                '2016-12-01',
            ],
            [
                'javascript:__doPostBack(\'btnDoes1016\',\'\')',
                'Video several does at the feeder October 2016',
                '2016-10-01',
            ],
            [
                'javascript:__doPostBack(\'btnTwinsAgain\',\'\')',
                'Video More of the Twins July 2017',
                '2017-07-01',
            ],
            [
                'javascript:__doPostBack(\'btnTwinFawns\',\'\')',
                'Video Twin Fawns July 2017',
                '2017-07-01',
            ],
            [
                'looping_images/Nov 2017 Ga Kudzu Buck/viewer.aspx',
                'South Georgia Nice- typical Buck (55 images)',
                '2017-11-01',
            ],
            [
                'javascript:__doPostBack(\'btnNGBear\',\'\')',
                'Video Waleska Bear April 2018',
                '2018-04-01',
            ],
            [
                'looping_images/Young velvet buck June 2 2018/viewer.aspx',
                'Young velvet buck June 2 2018 (135 images)',
                '2018-06-02',
            ],
            [
                '../looping_images/June_2018_Fawn/viewer.aspx',
                'June 2018 Fawn and Mom Typical Fawn! (18 images)',
                '2018-06-01',
            ],
            [
                'javascript:__doPostBack(\'btnJuly18Buck\',\'\')',
                'Video North GA Buck July 2018',
                '2018-07-01',
            ],
        ];
    }
}