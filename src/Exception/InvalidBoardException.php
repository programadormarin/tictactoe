<?php

namespace Hmarinjr\TicTacToe\Exception;

/**
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class InvalidBoardException extends \Exception
{
    /**
     * @var $message
     */
    public function __construct($message)
    {
        parent::__construct($message, 412);
    }
}
