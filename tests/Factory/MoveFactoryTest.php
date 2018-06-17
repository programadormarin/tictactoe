<?php

namespace Hmarinjr\TicTacToe\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Hmarinjr\TicTacToe\Factory\MoveFactory;

/**
 * Class MoveFactoryTest
 * @package Hmarinjr\TicTacToe\Tests\Factory
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class MoveFactoryTest extends TestCase
{
    public function testCreateMovesFromBoardState(): void
    {
        $moveFactory = $this->createMock('Hmarinjr\TicTacToe\Factory\MoveFactory');
        $boardState = [
            ["X", "O", "O"],
            ["X", "O", "O"],
            ["O", "X", "X"],
        ];
        $this->assertInstanceOf("Doctrine\Common\Collections\ArrayCollection", $moveFactory->createMovesFromBoardState($boardState));
    }

    public function testCreateMove()
    {
        $moveFactory = $this->createMock('Hmarinjr\TicTacToe\Factory\MoveFactory');
        $this->assertInstanceOf('Hmarinjr\TicTacToe\Entity\Move', $moveFactory->createMove(1, 2, 'O'));
    }
}
