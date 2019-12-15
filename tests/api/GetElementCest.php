<?php 

namespace Tests\api;

use \Codeception\Util\HttpCode;

class GetElementCest
{
    public function _before(\ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function tryToTestResult(\ApiTester $I)
    {
        $limit = 10;
        
        $I->sendGET('/element/', [
            'limit' => $limit,
            'sort' => 'created_at',
        ]);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->grabResponseAsArray();
        
        $I->assertEquals($limit, count($response));
        
        $element = $response[0];
        
        $I->assertArrayHasKey('id', $element);
        $I->assertArrayHasKey('title', $element);
        $I->assertArrayHasKey('link', $element);
        $I->assertArrayHasKey('created_at', $element);
        $I->assertArrayHasKey('updated_at', $element);
    }
}
