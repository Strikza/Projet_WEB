<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package App\Controller *
 * @Route("/test_template")
 */
class TestTemplateController extends AbstractController
{
    /**
     * @Route(
     *     "/",
     *     name="test_template"
     * )
     */
    public function testTemplateAction(): Response
    {
        $args = array(
            "user" => $this->getParameter('user')
        );

        return $this->render('/reception/reception.html.twig', $args);
    }
}