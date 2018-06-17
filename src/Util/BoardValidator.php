<?php

namespace Hmarinjr\TicTacToe\Util;

use Hmarinjr\TicTacToe\Exception\InvalidBoardException;

/**
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class BoardValidator
{
    /**
     * @param string $content
     *
     * @return bool
     * @throws InvalidBoardException
     */
    public function isValid($content): bool
    {
        if (empty($content)) {
            throw new InvalidBoardException("Invalid request. Empty body or invalid json.");
        }
        
        $board = $content['boardState'];
        if (empty($board) || count($board) !== 3) {
            throw new InvalidBoardException("A valid board has 3 lines.");
        }
    
        foreach ($board as $line) {
            if (count($line) !== 3) {
                throw new InvalidBoardException("A valid board line has 3 moves.");
            }
    
            $invalidValues = array_filter($line, function($move) {
                return ($move != 'O' && $move != 'X' && !empty($move));
            });
    
            if ($invalidValues) {
                throw new InvalidBoardException("The game must contain only 'X', 'O' or empty moves.");
            }
        }
    
        return true;
    }
}
