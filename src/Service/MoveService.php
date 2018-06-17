<?php

namespace Hmarinjr\TicTacToe\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Hmarinjr\TicTacToe\Entity\Board;
use Hmarinjr\TicTacToe\Entity\Move;
use Hmarinjr\TicTacToe\Factory\BoardFactory;
use Hmarinjr\TicTacToe\Factory\MoveFactory;

/**
 * Class MoveService
 * @package Hmarinjr\TicTacToe\Service
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class MoveService implements MoveInterface
{
    /**
     * {@inheritdoc}
     */
    public function makeMove(array $boardState, string $playerUnit = 'X'): array
    {
        $moves = $this->getEmptyPositions($boardState);
        shuffle($moves);
        $sortedMove = array_pop($moves);
        $arrayMove = explode('-', $sortedMove);
        $arrayMove[2] = $playerUnit == 'X' ? 'O' : 'X';
        return $arrayMove;
    }

    private function getEmptyPositions(array $boardState): array
    {
        $emptyPositions = [];
        foreach ($boardState as $indexLine => $line) {
            foreach ($line as $indexMove => $move) {
                if (empty($move)) {
                    $emptyPositions[] = $indexMove . '-' . $indexLine;
                }
            }
        }

        return $emptyPositions;
    }


}
