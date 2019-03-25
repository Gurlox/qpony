<?php

namespace App\Tests\Form;

use App\Components\SequenceInput;
use App\Form\SequenceInputType;
use App\Test\EOL;
use Symfony\Component\Form\Test\TypeTestCase;

class SequenceInputTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = ['inputs' => EOL::stringWithEOL('5 10')];

        $sequenceInput = new SequenceInput();
        $form = $this->factory->create(SequenceInputType::class, $sequenceInput);
        $rawSequenceInput = (new SequenceInput())->setInputs(EOL::stringWithEOL('5 10'));

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($rawSequenceInput, $sequenceInput);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
