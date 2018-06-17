<?php

namespace Hmarinjr\TicTacToe\Exception;

/**
 * Class EmptyAvailableMovesException
 * @package Hmarinjr\TicTacToe\Exception
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class InvalidBoardException extends \Exception
{
    /**
     * EmptyAvailableMovesException constructor.
     */
    public function __construct()
    {
        parent::__construct("No more empty moves on board!", 500);
    }
}
