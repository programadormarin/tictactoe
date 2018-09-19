<?php

namespace Hmarinjr\TicTacToe\Util;

use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

/**
 * @package Hmarinjr\TicTacToe\Util
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class GameStatusTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider winnerBoardsProvider
     *
     * @param array $requestContent
     */
    public function whenHaveWinnerHaveToReturnIt(array $board, string $winner)
    {
        $gameStatus = new GameStatus($board);

        $this->assertEquals($winner, $gameStatus->getWinner());
    }

    /**
     * @test
     * @dataProvider tiedBoardsProvider
     *
     * @param array $requestContent
     */
    public function whenHaveTiedBoardHaveToReturnTrue(array $board)
    {
        $gameStatus = new GameStatus($board);

        $this->assertTrue($gameStatus->IsTied());
    }

    /**
     * @test
     * @dataProvider winnerBoardsProvider
     *
     * @param array $requestContent
     */
    public function whenHaveWinnerHaveToReturnFalseOnVerifyIfIsTied(array $board, $winner)
    {
        $gameStatus = new GameStatus($board);

        $this->assertFalse($gameStatus->IsTied());
    }

    /**
     * @test
     * @dataProvider boardsWithFreeMovesProvider
     *
     * @param array $requestContent
     */
    public function whenHaveHaveFreeMovesIsTiedHaveToReturnFalse(array $board)
    {
        $gameStatus = new GameStatus($board);

        $this->assertFalse($gameStatus->IsTied());
    }

    public function winnerBoardsProvider(): array
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
                    ["X", "O", "O"],
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
                    ["X", "O", "O"],
                    ["O", "O", "X"],
                    ["X", "X", "X"]
                ],
                'X'
            ],
            [
                [
                    ["X", "O", "O"],
                    ["O", "O", "X"],
                    ["X", "O", "X"]
                ],
                'O'
            ],
            [
                [
                    ["X", "O", "X"],
                    ["O", "X", "O"],
                    ["O", "O", "X"]
                ],
                'X'
            ]

        ];
    }

    public function tiedBoardsProvider(): array
    {
        return [
            [
                [
                    ["O", "O", "X"],
                    ["X", "X", "O"],
                    ["O", "X", "X"]
                ]
            ],
            [
                [
                    ["X", "O", "X"],
                    ["X", "O", "O"],
                    ["O", "X", "X"]
                ]
            ],
            [
                [
                    ["X", "O", "O"],
                    ["O", "X", "X"],
                    ["X", "X", "O"]
                ]
            ],
            [
                [
                    ["X", "O", "O"],
                    ["O", "O", "X"],
                    ["X", "X", "O"]
                ]
            ],
            [
                [
                    ["X", "X", "O"],
                    ["O", "O", "X"],
                    ["X", "O", "X"]
                ]
            ],
            [
                [
                    ["O", "O", "X"],
                    ["X", "X", "O"],
                    ["O", "O", "X"]
                ]
            ]

        ];
    }

    public function boardsWithFreeMovesProvider(): array
    {
        return [
            [
                [
                    ["O", "O", "X"],
                    ["X", "X", "O"],
                    ["O", "X", ""]
                ]
            ],
            [
                [
                    ["X", "O", "X"],
                    ["X", "", "O"],
                    ["O", "X", "X"]
                ]
            ],
            [
                [
                    ["X", "", "O"],
                    ["O", "X", "X"],
                    ["", "X", "O"]
                ]
            ],
            [
                [
                    ["", "O", "O"],
                    ["O", "O", "X"],
                    ["X", "X", "O"]
                ]
            ],
            [
                [
                    ["X", "X", "O"],
                    ["O", "O", ""],
                    ["X", "O", "X"]
                ]
            ],
            [
                [
                    ["O", "O", ""],
                    ["X", "X", "O"],
                    ["O", "O", "X"]
                ]
            ]

        ];
    }
}
