<?php

namespace Hmarinjr\TicTacToe\Service;


use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

/**
 * MoveServiceTest
 * @package Hmarinjr\TicTacToe\Service
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class MoveServiceTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider validRequestProvider
     */
    public function makeMoveHaveToReturnPossibleMove(array $board, string $playerUnit)
    {
        $service = new MoveService();
        $move = $service->makeMove($board, $playerUnit);

        $this->assertEquals(3, count($move));
    }

    /**
     * @test
     * @dataProvider fullBoardProvider
     */
    public function ifTheGameisOverHaveToReturnEmptyArray(array $board, string $playerUnit)
    {
        $service = new MoveService();
        $move = $service->makeMove($board, $playerUnit);

        $this->assertEmpty($move);
    }

    public function validRequestProvider(): array
    {
        return [

            [
                [
                    ["O", "O", "O"],
                    ["X", "X", ""],
                    ["O", "X", "X"]
                ],
                'O'
            ],
            [
                [
                    ["X", "O", ""],
                    ["X", "O", "O"],
                    ["O", "X", "X"]
                ],
                'O'
            ],
            [
                [
                    ["X", "O", "O"],
                    ["O", "", "O"],
                    ["X", "X", "O"]
                ],
                'O'
            ],
            [
                [
                    ["X", "", ""],
                    ["O", "", "X"],
                    ["X", "X", "X"]
                ],
                'X'
            ],
            [
                [
                    ["X", "O", "O"],
                    ["", "O", "X"],
                    ["", "", ""]
                ],
                'O'
            ],
            [
                [
                    ["", "", ""],
                    ["", "", ""],
                    ["", "", "X"]
                ],
                'X'
            ]

        ];
    }

    public function fullBoardProvider(): array
    {
        return [

            [
                [
                    ["O", "O", "O"],
                    ["X", "X", "O"],
                    ["O", "X", "X"]
                ],
                'O'
            ],
            [
                [
                    ["X", "O", "X"],
                    ["X", "O", "O"],
                    ["O", "X", "X"]
                ],
                'O'
            ],
            [
                [
                    ["X", "O", "O"],
                    ["O", "X", "O"],
                    ["X", "X", "O"]
                ],
                'O'
            ],
            [
                [
                    ["X", "X", "O"],
                    ["O", "O", "X"],
                    ["X", "X", "X"]
                ],
                'X'
            ],
            [
                [
                    ["X", "O", "X"],
                    ["X", "O", "X"],
                    ["O", "X", "O"]
                ],
                'O'
            ],
            [
                [
                    ["X", "X", "O"],
                    ["O", "O", "X"],
                    ["X", "O", "X"]
                ],
                'X'
            ]

        ];
    }
}
