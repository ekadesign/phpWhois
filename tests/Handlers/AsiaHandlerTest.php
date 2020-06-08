<?php
/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace phpWhois\Handlers;

/**
 * AsiaHandlerTest
 */
class AsiaHandlerTest extends HandlerTest
{
    /**
     * @var AsiaHandler $handler
     */
    protected $handler;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->handler            = new AsiaHandler();
        $this->handler->asiaepWhois = false;
    }

    /**
     * @return void
     *
     * @test
     */
    public function parseNicDotAsia()
    {
        $query = 'nic.asia';

        $fixture = $this->loadFixture($query);
        $data    = [
            'rawdata'  => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                'name'    => 'NIC.ASIA',
                'changed' => '2020-04-28',
                'created' => '2020-02-28',
                'expires' => '2021-02-28',
            ],
            'registered' => 'yes',
        ];

        $this->assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        $this->assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}
