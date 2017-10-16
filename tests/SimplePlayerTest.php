<?php

use PHPUnit\Framework\TestCase;
use Schellingerht\TicTacToe\Player\PlayerInterface;
use Schellingerht\TicTacToe\Player\SimplePlayer;

/**
 * Class SimplePlayerTest
 */
final class SimplePlayerTest extends TestCase
{
    /** @test */
    public function it_creates_a_player_instance_which_implements_interface_expects_true()
    {
        $this->assertTrue(new SimplePlayer('dummy') instanceof PlayerInterface);
    }

    /** @test */
    public function it_creates_a_player_instance_with_name_dummy_expects_name_dummy()
    {
        $player = new SimplePlayer('dummy');
        $this->assertEquals($player->name(), 'dummy');
    }
}