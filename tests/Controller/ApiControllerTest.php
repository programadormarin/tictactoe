<?php

namespace Hmarinjr\TicTacToe\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Hmarinjr\TicTacToe\Controller\ApiController;
use Hmarinjr\TicTacToe\Exception\InvalidRequestException;
use Hmarinjr\TicTacToe\Service\MoveInterface;

/**
 * Class ApiControllerTest
 * @package Hmarinjr\TicTacToe\Tests\Controller
 *
 * @author Hermenegildo Marin Júnior <hmarinjr@gmail.com>
 */
class ApiControllerTest extends WebTestCase
{
    /**
     * @dataProvider validRequestProvider
     *
     * @param array $requestContent
     *
     * @throws InvalidRequestException
     */
    public function testApiController(array $requestContent)
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
     * @dataProvider validRequestProvider
     * @param array $invalidRequestContent
     */
    public function testMakeMove(array $invalidRequestContent): void
    {
        $requestContent = json_encode($invalidRequestContent);

        $client = static::createClient();
        $client->request('POST', '/api/move', [], [], [], $requestContent);
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));

        $contentBody = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('nextMove', $contentBody);
    }

    /**
     * @dataProvider invalidRequestProvider
     *
     * @param array $invalidRequestContent
     */
    public function testInvalidMakeMove(array $invalidRequestContent): void
    {
        $invalidContent = json_encode($invalidRequestContent);

        $client = static::createClient();
        $client->request('POST', '/api/move', [], [], [], $invalidContent);
        $this->assertSame(412, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));
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
