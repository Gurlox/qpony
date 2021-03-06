<?php

namespace App\Controller;

use App\Components\SequenceInput;
use App\Form\SequenceInputType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SequenceController extends AbstractController
{
    /**
     * @Route("/", name="sequenceForm")
     */
    public function formAction(Request $request)
    {
        /** @var SequenceInput $sequenceInput */
        $sequenceInput = new SequenceInput();
        $form = $this->createForm(SequenceInputType::class, $sequenceInput)->handleRequest($request);

        return $this->render('base.html.twig', [
            'form' => $form->createView(),
            'sequenceInput' => $sequenceInput
        ]);
    }
}
