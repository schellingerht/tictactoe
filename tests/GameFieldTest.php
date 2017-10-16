<?php

use PHPUnit\Framework\TestCase;
use Schellingerht\TicTacToe\GameField;
use Schellingerht\TicTacToe\Jury\SimpleJury;

/**
 * Class GameFieldTest
 */
final class GameFieldTest extends TestCase
{
    /** @test */
    public function it_creates_an_instance_of_game_field_expects_instance_is_object_is_true()
    {
        $gameField = new GameField(3, 'SimpleTile', new SimpleJury($size = 3));
        $this->assertTrue(is_object($gameField));
    }

    /** @test */
    public function it_gets_the_tiles_of_gamefield_expects_9()
    {
        $gameField = new GameField(3, 'SimpleTile', new SimpleJury($size = 3));

        // size 3 means width 3 and height 3 -> 3x3
        $this->assertCount(9, $gameField->tiles());
    }
}