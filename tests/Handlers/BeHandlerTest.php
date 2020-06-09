<?php
/**
 * @copyright Copyright (c) 2020 Joshua Smith
 * @license   See LICENSE file
 */

namespace phpWhois\Handlers;

/**
 * BeHandlerTest
 */
class BeHandlerTest extends HandlerTest
{
    /**
     * @var BeHandler $handler
     */
    protected $handler;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->handler            = new BeHandler();
        $this->handler->deepWhois = false;
    }

    /**
     * @return void
     *
     * @test
     */
    public function parseNicDotBe()
    {
        $query = 'nic.be';

        $fixture = $this->loadFixture($query);
        $data    = [
            'rawdata'  => $fixture,
            'regyinfo' => [],
        ];

        $actual = $this->handler->parse($data, $query);

        $expected = [
            'domain'     => [
                'name'    => 'nic.be',
                // 'changed' => '2018-01-24',
                'created' => '1998-04-01',
            ],
            'registered' => 'yes',
        ];

        $this->assertArraySubset($expected, $actual['regrinfo'], 'Whois data may have changed');
        $this->assertArrayHasKey('rawdata', $actual);
        $this->assertArraySubset($fixture, $actual['rawdata'], 'Fixture data may be out of date');
    }
}