<?php 

namespace Tests\api;

use \Codeception\Util\HttpCode;

/**
 * @author Marcin Szostak <marcin.szostak@luxurno.pl>
 */
class GetElementPhotoCest
{
    const ID = 2;
    
    public function _before(\ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     */
    public function tryToTestElementPhotoResult(\ApiTester $I)
    {
        $I->sendGET('/element/photos/'.self::ID, []);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $response = $I->grabResponseAsArray();
        
        $I->assertEquals(1, count($response));
        $element = $response[0];
        
        $I->assertArrayHasKey('id', $element);
        $I->assertArrayHasKey('element_id', $element);
        $I->assertArrayHasKey('href', $element);
        $I->assertArrayHasKey('created_at', $element);
        $I->assertArrayHasKey('updated_at', $element);
    }
}
