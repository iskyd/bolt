<?php

namespace Bolt\Tests\Twig;

use Bolt\Tests\BoltUnitTest;
use Bolt\Twig\Handler\UserHandler;

/**
 * Class to test Bolt\Twig\Handler\UserHandler
 *
 * @author Gawain Lynch <gawain.lynch@gmail.com>
 */
class UserHandlerTest extends BoltUnitTest
{
    protected function setUp()
    {
        $app = $this->getApp();
        $this->addDefaultUser($app);
    }

    public function testGetUserById()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUser(1);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('username', $result);
        $this->assertArrayHasKey('password', $result);
        $this->assertArrayHasKey('email', $result);
    }

    public function testGetUserByUsername()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUser('admin');
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('username', $result);
        $this->assertArrayHasKey('password', $result);
        $this->assertArrayHasKey('email', $result);
    }

    public function testGetUserByEmail()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUser('admin@example.com');
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('username', $result);
        $this->assertArrayHasKey('password', $result);
        $this->assertArrayHasKey('email', $result);
    }

    public function testGetUserIdInvalid()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUserId(42);
        $this->assertFalse($result);
    }

    public function testGetUserIdById()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUserId(1);
        $this->assertSame(1, $result);
    }

    public function testGetUserIdByUsername()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUserId('admin');
        $this->assertSame(1, $result);
    }

    public function testGetUserIdByEmail()
    {
        $app = $this->getApp();
        $handler = new UserHandler($app);

        $result = $handler->getUserId('admin@example.com');
        $this->assertSame(1, $result);
    }
}
