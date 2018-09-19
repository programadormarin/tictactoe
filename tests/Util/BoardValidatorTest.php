<?php

namespace Hmarinjr\TicTacToe\Util;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hmarinjr\TicTacToe\Controller\ApiController;
use Hmarinjr\TicTacToe\Service\MoveInterface;

/**
 * @package Hmarinjr\TicTacToe\Util
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class BoardValidatorTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider invalidRequestProvider
     * @expectedException \Exception
     *
     * @param array $invalidRequestContent
     */
    public function onInvalidMovementHaveToThrowInvalidBoardtException (array $invalidRequestContent): void
    {
        $validator = new BoardValidator();

        $validator->isValid($invalidRequestContent);
    }

    public function invalidRequestProvider(): array
    {
        return [
            [
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],
                [
                    "playerUnit" => "Y",
                    "boardState" => [
                        ["X", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "Z"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "Z"],
                        ["O", "X", "X"],
                    ],
                ],
                [
                    "playerUnit" => "X",
                ],
                [
                    "boardState" => [
                        ["X", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],
            ],
        ];
    }
}