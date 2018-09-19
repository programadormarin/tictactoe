<?php

namespace Hmarinjr\TicTacToe\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hmarinjr\TicTacToe\Controller\ApiController;
use Hmarinjr\TicTacToe\Service\MoveInterface;

/**
 * @package Hmarinjr\TicTacToe\Controller
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class ApiControllerTest extends WebTestCase
{

    /**
     * @test
     * @dataProvider validWithFreeMovesProvider
     *
     * @param array $validRequestContent
     */
    public function makeWithFreeMovesWillReturnWinnerTiedAndNextMove(array $validRequestContent): void
    {
        $requestContent = json_encode($validRequestContent);

        $client = static::createClient();
        $client->request('POST', '/api/move', [], [], [], $requestContent);
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));

        $contentBody = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('nextMove', $contentBody);
        $this->assertArrayHasKey('winner', $contentBody);
        $this->assertArrayHasKey('tied', $contentBody);
    }

    /**
     * @test
     * @dataProvider validRequestProvider
     *
     * @param array $validRequestContent
     */
    public function makeWithouFreeMoveWillReturnWinnerAndTiedResult(array $validRequestContent): void
    {
        $requestContent = json_encode($validRequestContent);

        $client = static::createClient();
        $client->request('POST', '/api/move', [], [], [], $requestContent);
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));

        $contentBody = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('winner', $contentBody);
        $this->assertArrayHasKey('tied', $contentBody);
    }

    public function validRequestProvider(): array
    {
        return [
            [
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ]
                ]
            ],
            [
                [
                    "playerUnit" => "O",
                    "boardState" => [
                        ["X", "O", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ]
                ]
            ],
            [
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ]
                ]
            ],[
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "X"],
                        ["O", "X", "O"],
                        ["X", "O", "X"],
                    ]
                ]
            ]
        ];
    }

    public function validWithFreeMovesProvider(): array
    {
        return [
            [
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", ""],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ]
                ]
            ],
            [
                [
                    "playerUnit" => "O",
                    "boardState" => [
                        ["X", "O", ""],
                        ["X", "O", ""],
                        ["O", "X", "X"],
                    ]
                ]
            ],
            [
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", ""],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ]
                ]
            ],[
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "X"],
                        ["O", "", "O"],
                        ["X", "O", "X"],
                    ]
                ]
            ]
        ];
    }
}
