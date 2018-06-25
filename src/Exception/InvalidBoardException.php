<?php

namespace Hmarinjr\TicTacToe\Exception;

/**
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class InvalidBoardException extends \Exception
{
    /**
     * @var string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message, 412);
    }
}
