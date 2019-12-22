<?php 

namespace Tests\api;

use \Codeception\Util\HttpCode;
use ApiTester;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GetElementCest
{
    const LIMIT = 10;
    
    public function _before(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function tryToTestResult(ApiTester $I): void
    {
        $I->sendGET('/v1/element/', [
            'limit' => self::LIMIT,
            'sort' => 'created_at',
        ]);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->grabResponseAsArray();
        
        $I->assertEquals(self::LIMIT, count($response));
        $element = $response[0];
        
        $I->assertArrayHasKey('id', $element);
        $I->assertArrayHasKey('title', $element);
        $I->assertArrayHasKey('link', $element);
        $I->assertArrayHasKey('date', $element);
        $I->assertArrayHasKey('created_at', $element);
        $I->assertArrayHasKey('updated_at', $element);
    }


    /**
     * @param ApiTester $I
     */
    public function trytoTestElementWithSortDate(ApiTester $I): void
    {
        $I->sendGET('/v1/element/', [
            'limit' => '20',
            'sort_type' => 'date',
            'sort_by' => 'asc',
        ]);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->grabResponseAsArray();

        $array = [];
        foreach ($response as $key => $value) {
            $array[] = $value['date'];
        }
        sort($array);

        foreach ($response as $key => $value) {
            $I->assertEquals($array[$key], $value['date']);
        }
    }

    /**
     * @param ApiTester $I
     */
    public function trytoTestElementWithSortPhotoNumber(ApiTester $I): void
    {
        $I->sendGET('/v1/element/', [
            'limit' => '20',
            'sort_type' => 'photo_number',
            'sort_by' => 'desc',
        ]);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->grabResponseAsArray();

        $array = [];
        foreach ($response as $key => $value) {
            $array[] = $value['photo_number'];
        }
        rsort($array);

        foreach ($response as $key => $value) {
            $I->assertEquals($array[$key], $value['photo_number']);
        }
    }

}
