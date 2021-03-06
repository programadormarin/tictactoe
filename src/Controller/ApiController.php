<?php

namespace Hmarinjr\TicTacToe\Controller;

use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/move", defaults={"_format": "json"}), methods={"POST"})
     *
     * @param MoveInterface $moveService
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function moveAction(MoveInterface $moveService, Request $request): JsonResponse
    {
        $actualGame = json_decode($this->getStringRequestContent($request), true);

        $validator = new BoardValidator();
        $validator->isValid($actualGame);

        return $this->verifyGameStatus($moveService, $actualGame['boardState'], $actualGame['playerUnit']);
    }

    /**
     * @return string
     */
    private function getStringRequestContent(Request $request): string
    {
        $requestContent = $request->getContent();

        if (!is_string($request->getContent())) {
            throw new \InvalidArgumentException('The content is invalid!');
        }

        return $requestContent;
    }

    private function verifyGameStatus(MoveInterface $moveService, array $board, string $playerUnit): JsonResponse
    {
        $gameStatus = new GameStatus($board);

        if (!empty($gameStatus->getWinner()) || $gameStatus->isTied()) {
            $response['winner'] = $gameStatus->getWinner();
            $response['tied'] = $gameStatus->isTied();
            return new JsonResponse($response, 200);
        }

        $computerMove = $moveService->makeMove($board, $playerUnit);

        if (!empty($computerMove[1])) {
            $board[$computerMove[0]][$computerMove[1]] = $computerMove[2];
        }

        $gameStatus = new GameStatus($board);
        $response = [
            'nextMove' => $computerMove,
            'winner' => $gameStatus->getWinner(),
            'tied' => $gameStatus->isTied()
        ];

        return new JsonResponse($response, 200);
    }
}
