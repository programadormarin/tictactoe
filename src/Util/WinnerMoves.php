<?php

namespace Hmarinjr\TicTacToe\Util;

/**
 * Class WinnerMoves
 * @package Hmarinjr\TicTacToe\Util
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class WinnerMoves
{
    /**
     * @return array
     */
    public static function getWinnerMoves(): array
    {
        return [
            [[0, 0, 1], [0, 0, 1], [0, 0, 1]],
            [[1, 1, 1], [0, 0, 0], [0, 0, 0]],
            [[0, 0, 0], [0, 0, 0], [1, 1, 1]],
            [[1, 0, 0], [1, 0, 0], [1, 0, 0]],
            [[0, 0, 0], [1, 1, 1], [0, 0, 0]],
            [[0, 1, 0], [0, 1, 0], [0, 1, 0]],
            [[1, 0, 0], [0, 1, 0], [0, 0, 1]],
            [[0, 0, 1], [0, 1, 0], [1, 0, 0]]            
        ];
    }
}
