<?php

declare(strict_types = 1);

namespace App\Tests\unit\Bundle\DownloadBundle\Validator;

use App\Bundle\DownloadBundle\Validator\ElementPhotoValidator;

class ElementPhotoValidatorTest extends \Codeception\Test\Unit
{
    public function testValidateFunction(): void
    {
        $elementPhotoValidator = new ElementPhotoValidator();

        $matched = 'http://www.watchthedeer.com/looping_images/June_2018_Fawn/viewer.aspx';
        $this->assertTrue($elementPhotoValidator->validate($matched));

        $notMatched = "http://www.watchthedeer.com/looping_images/June_2018_Fawn/viewer.jpg";
        $this->assertFalse($elementPhotoValidator->validate($notMatched));
    }
}