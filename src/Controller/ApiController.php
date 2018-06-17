<?php

namespace Hmarinjr\TicTacToe\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Hmarinjr\TicTacToe\Util\BoardValidator;
use Hmarinjr\TicTacToe\Service\MoveInterface;
use Hmarinjr\TicTacToe\Util\GameStatus;
use Hmarinjr\TicTacToe\Util\WinnerMoves;

/**
 * Class ApiController
 * @package Hmarinjr\TicTacToe\Controller
 * @Route("/api")
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class ApiController extends Controller
{
    /**
     * @Route("/move", defaults={"_format": "json"})
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws InvalidRequestException
     */
    public function moveAction(MoveInterface $move, Request $request): JsonResponse
    {
        $movement = json_decode($request->getContent(), true);

        $validator = new BoardValidator();        
        $validator->isValid($movement);

        $gameStatus = new GameStatus($movement['boardState'], $movement['playerUnit']);

        if (!empty($gameStatus->getWinner())) {
            $response['winner'] = $gameStatus->getWinner();
            return new JsonResponse($response, 200);
        }

        $response = ['nextMove' => $move->makeMove($movement['boardState'], $movement['playerUnit'])];
        
        if (!empty($response['nextMove'][1])) {
            $movement['boardState'][$response['nextMove'][0]][$response['nextMove'][1]] = $response['nextMove'][2];
        }

        $gameStatus = new GameStatus($movement['boardState'], $movement['playerUnit']);

        if ($gameStatus->isTied()) {
            $response['tied'] = $gameStatus->isTied();
        }

        return new JsonResponse($response, 200);
    }
}
