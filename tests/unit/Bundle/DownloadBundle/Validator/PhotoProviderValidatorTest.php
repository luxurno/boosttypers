<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Validator;

use App\Bundle\DownloadBundle\Validator\PhotoProviderValidator;

class PhotoProviderValidatorTest extends \Codeception\Test\Unit
{
    public function testValidateFunction(): void
    {
        $photoProviderValidator = new PhotoProviderValidator();

        $matched = 'http://www.watchthedeer.com/looping_images/June_2018_Fawn/some-address.jpg';
        $this->assertTrue($photoProviderValidator->validate($matched));

        $notMatched = "http://www.watchthedeer.com/looping_images/June_2018_Fawn/viewer.aspx";
        $this->assertFalse($photoProviderValidator->validate($notMatched));
    }
}