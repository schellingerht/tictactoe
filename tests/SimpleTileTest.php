<?php

use PHPUnit\Framework\TestCase;
use Schellingerht\TicTacToe\Tile\SimpleTile;
use Schellingerht\TicTacToe\Player\SimplePlayer;

/**
 * Class SimpleTileTest
 */
final class SimpleTileTest extends TestCase
{
    /** @test */
    public function it_creates_a_tile_instance_which_implements_interface_expects_true()
    {
        $this->assertTrue(new SimpleTile(1, 1) instanceof SplSubject);
    }

    /** @test */
    public function it_receives_a_player_and_notify_the_jury()
    {
        $tile = new SimpleTile(1, 1);
        $player = new SimplePlayer('dummy');

        /**
         * @ToDo Mock Simple Jury or Interface
         */

        $this->assertTrue(is_object($tile));
        $this->assertTrue(is_object($player));
    }

    /** @test */
    public function it_gets_an_object_with_simple_tile_info_expects_object_with_player_null()
    {
        $tile = new SimpleTile(1, 1);

        $this->assertEquals($tile->tile(), (object) [
            'row' => $tile->tile()->row,
            'col' => $tile->tile()->col,
            'player' => null
        ]);
    }

    /** @test */
    public function it_gets_an_object_with_simple_tile_info_after_player_arrives_expects_object_with_player()
    {
        $tile = new SimpleTile(1, 1);
        $player = new SimplePlayer('dummy');

        $tile->at($player);

        $this->assertEquals($tile->tile(), (object) [
            'row' => $tile->tile()->row,
            'col' => $tile->tile()->col,
            'player' => $player
        ]);
    }
}