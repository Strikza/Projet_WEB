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
    public function indexAction(): Response
    {
        return $this->render('/users_authentification/layout_admin.html.twig');
    }
}