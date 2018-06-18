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
     */
    public function moveAction(MoveInterface $move, Request $request): JsonResponse
    {
        $actualGame = json_decode($request->getContent(), true);

        $validator = new BoardValidator();        
        $validator->isValid($actualGame);

        $gameStatus = new GameStatus($actualGame['boardState'], $actualGame['playerUnit']);

        if (!empty($gameStatus->getWinner()) || $gameStatus->isTied()) {
            $response['winner'] = $gameStatus->getWinner();
            $response['tied'] = $gameStatus->isTied();
            return new JsonResponse($response, 200);
        }

        $move = $move->makeMove($actualGame['boardState'], $actualGame['playerUnit']);
        
        if (!empty($move[1])) {
            $actualGame['boardState'][$move[0]][$move[1]] = $move[2];
        }

        $gameStatus = new GameStatus($actualGame['boardState'], $actualGame['playerUnit']);        
        $response = [
            'nextMove' => $move,
            'winner' => $gameStatus->getWinner(),
            'tied' => $gameStatus->isTied()
        ];

        return new JsonResponse($response, 200);
    }
}
