<?php

namespace Hmarinjr\TicTacToe\Tests\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Hmarinjr\TicTacToe\Factory\BoardFactory;
use Hmarinjr\TicTacToe\Factory\MoveFactory;

/**
 * Class BoardFactoryTest
 * @package Hmarinjr\TicTacToe\Tests\Factory
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class BoardFactoryTest extends TestCase
{
    public function testCreateBoard(): void
    {
        $arrayCollection = $this->createMock('Doctrine\Common\Collections\ArrayCollection');
        $moveFactory = $this->createMock('Hmarinjr\TicTacToe\Factory\MoveFactory');
        $moveFactory->expects($this->any())
            ->method('createMovesFromBoardState')
            ->with([
                ["X", "O", "O"],
                ["X", "O", "O"],
                ["O", "X", "X"],
            ])
            ->will($this->returnValue($arrayCollection));

        $boardFactory = $this->getMockBuilder('Hmarinjr\TicTacToe\Factory\BoardFactory')
            ->getMock();

        $this->assertInstanceOf("Hmarinjr\TicTacToe\Entity\Board", $boardFactory->createBoard($arrayCollection));
        $this->assertInstanceOf(
            "Doctrine\Common\Collections\ArrayCollection",
            $boardFactory->createBoard($arrayCollection)->getMoves()
        );
    }
}
