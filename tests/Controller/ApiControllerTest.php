<?php

namespace Hmarinjr\TicTacToe\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hmarinjr\TicTacToe\Controller\ApiController;
use Hmarinjr\TicTacToe\Exception\InvalidBoardtException;
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
     * @dataProvider validRequestProvider
     *
     * @param array $requestContent
     */
    public function apiController(array $requestContent)
    {
        $request = $this->createMock("Symfony\Component\HttpFoundation\Request");
        $container = $this->createMock("Symfony\Component\DependencyInjection\ContainerInterface");
        $service = $this->createMock(MoveInterface::class);

        $request->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($requestContent));

        $controller = new ApiController();
        $controller->setContainer($container);
        $controller->moveAction($service, $request);
    }

    /**
     * @test
     * @dataProvider validRequestProvider
     * 
     * @param array $validRequestContent
     */
    public function makeMove(array $validRequestContent): void
    {
        $requestContent = json_encode($validRequestContent);

        $client = static::createClient();
        $client->request('POST', '/api/move', [], [], [], $requestContent);
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));

        $contentBody = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('winner', $contentBody);
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
                    ],
                ],
                [
                    "playerUnit" => "O",
                    "boardState" => [
                        ["X", "O", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],
                [
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "O"],
                        ["X", "O", "O"],
                        ["O", "X", "X"],
                    ],
                ],[
                    "playerUnit" => "X",
                    "boardState" => [
                        ["X", "O", "X"],
                        ["O", "X", "O"],
                        ["X", "O", "X"],
                    ],
                ],
            ],
        ];
    }
}
