<?php

namespace Hmarinjr\TicTacToe\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 * @package Hmarinjr\TicTacToe\Controller
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class IndexController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function indexAction(): Response
    {
        return $this->render('home.html.twig');
    }
}
