<?php

use CodesWholesaleFramework\Connection\ConnectionImpl;
use CodesWholesale\Client;

/**
 * Created by PhpStorm.
 * User: maciejklowan
 * Date: 10/06/16
 * Time: 10:51
 */
class ConnectionTest extends TestCase
{
    /**
     * @var ConnectionImpl
     */
    private $connection;

    public function setUp()
    {
        parent::setUp();
        $this->connection = new ConnectionImpl();
    }

    public function testShouldReturnClient() {
        $client = $this->connection->getConnection(['environment' => 0, 'db' => new PDO('sqlite::memory:'), 'client_headers' => 'Test']);
        $this->assertInstanceOf(Client::class, $client);
    }
}