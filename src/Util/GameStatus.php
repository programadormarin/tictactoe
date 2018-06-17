<?php

namespace Hmarinjr\TicTacToe\Util;

/**
 * Class GameStatus
 * @package Hmarinjr\TicTacToe\Util
 */
class GameStatus
{
    /**
     * @var string[][]
     */
    private $board;

    /**
     * GameStatus constructor.
     *
     * @param array $board
     * @param string $playerUnit
     */
    public function __construct(array $board)
    {
        $this->board = $board;
    }

    public function getWinner(): string
    {
        $winnerMoves = WinnerMoves::getWinnerMoves();

        foreach ($winnerMoves as $indexLine => $winnerBoard) {
            $checkX = $checkO = 0;

            foreach ($this->board as $indexLine => $line) {
                foreach ($line as $indexMove => $move) {
                    if ($move === 'X' && $winnerBoard[$indexLine][$indexMove]) {
                        ++$checkX;
                    }

                    if ($move === 'O' && $winnerBoard[$indexLine][$indexMove]) {
                        ++$checkO;
                    }
                }
            }

            if ($checkX == 3) {
                return 'X';
            }

            if ($checkO == 3) {
                return 'O';
            }
        }

        return '';
    } 

    public function isTied()
    {
        if ($this->getWinner()) {
            return false;
        }

        $openMove = false;
        $computerBoard = array_filter($this->board, function ($line) {
            return !empty(array_filter($line, function ($column) { 
                return empty($column);
            }));
        });

        return count($computerBoard) == 0;
    }
}
