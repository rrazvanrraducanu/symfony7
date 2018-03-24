<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class LowerController extends Controller
{
    /**
     * @Route("/lower", name="lower")
     */
    public function index(Request $request)
    {
        $data = [];
        $form = $this->createFormBuilder()
            ->add('text1', TextType::class, array('attr' => array('size' => '30', 'placeholder' => 'bau bau')))
            ->add('submit', SubmitType::class)
            ->add('text2', TextType::class, array('attr' => array('size' => '30', 'placeholder' => 'bau bau'), 'required' => false))
            ->add('radio', ChoiceType::class, array(
                'choices' => array('Lower' => true, 'Upper' => false),
                'expanded' => true,
                'multiple' => false,
                // 'choices_as_values' => true,
            ))
            ->getForm();
        $form->handleRequest($request);
        $data['head'] = "<h1>Input your data</h1>";
        $data['form'] = $form->createView();

        if ($form->isSubmitted()) {
            if ($form->get('radio')->getData() == 'lower') {
                $data['value2'] = strtolower($form->get('text1')->getData());
            } else {
                $data['value2'] = strtoupper($form->get('text1')->getData());
            }
            $data['value1'] = '';
        } else {
            $data['value1'] = '';
            $data['value2'] = '';
        }
        return $this->render('lower/index.html.twig', $data);
    }
}