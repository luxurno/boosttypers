<?php 

namespace Tests\api;

use \Codeception\Util\HttpCode;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GetElementCest
{
    const LIMIT = 10;
    
    public function _before(\ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function tryToTestResult(\ApiTester $I)
    {
        $I->sendGET('/element/', [
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
        $I->assertArrayHasKey('created_at', $element);
        $I->assertArrayHasKey('updated_at', $element);
    }
}
