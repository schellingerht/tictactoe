<?php

use PHPUnit\Framework\TestCase;
use Schellingerht\TicTacToe\GameField;
use Schellingerht\TicTacToe\Jury\JuryInterface;
use Schellingerht\TicTacToe\Jury\SimpleJury;
use Schellingerht\TicTacToe\Player\PlayerInterface;
use Schellingerht\TicTacToe\Player\SimplePlayer;
use Schellingerht\TicTacToe\Tile\TileInterface;

/**
 * Class SimpleJuryTest
 */
final class SimpleJuryTest extends TestCase
{
    /**
     * @var int Size of the game field
     */
    private $size;

    /**
     * @var GameField Responsible for creating the game field with $size * $size tiles
     */
    private $gameField;

    /**
     * @var TileInterface[] Array of tiles
     */
    private $tiles;

    /**
     * @var JuryInterface Check the winner of the game
     */
    private $jury;

    /**
     * @var PlayerInterface Player 1 of the game
     */
    private $player1;

    /**
     * @var PlayerInterface Player 2 of the game
     */
    private $player2;

    public function setUp()
    {
        $this->size = 3;
        $this->jury = $jury = new SimpleJury(3);
        $this->gameField = new GameField(3, 'SimpleTile', $this->jury);
        $this->tiles = $this->gameField->tiles();
        $this->player1 = new SimplePlayer('player1');
        $this->player2 = new SimplePlayer('player2');
    }

    /** @test */
    public function it_checks_the_result_of_player_which_sets_A1_A2_A3_expects_true()
    {
        $this->tiles[0]->at($this->player1); // Tile A1
        $this->tiles[1]->at($this->player1); // Tile A2
        $this->tiles[2]->at($this->player1); // Tile A3

        $this->assertTrue($this->jury->check($this->player1));
    }

    /** @test */
    public function it_checks_the_result_of_player_which_sets_A1_A2_B3_expects_false()
    {
        $this->tiles[0]->at($this->player1); // Tile A1
        $this->tiles[1]->at($this->player1); // Tile A2
        $this->tiles[5]->at($this->player1); // Tile B3

        $this->assertFalse($this->jury->check($this->player1));
    }

    /** @test */
    public function it_checks_the_result_of_player_which_sets_A1_B2_C3_expects_true()
    {
        $this->tiles[0]->at($this->player1); // Tile A1
        $this->tiles[4]->at($this->player1); // Tile B2
        $this->tiles[8]->at($this->player1); // Tile C3

        $this->assertTrue($this->jury->check($this->player1));
    }

    /** @test */
    public function it_checks_the_result_of_player1_which_sets_A1_B2_C3_expects_true_and_player2_expects_false()
    {
        $this->tiles[0]->at($this->player1); // Tile A1
        $this->tiles[1]->at($this->player2); // Tile A2
        $this->tiles[4]->at($this->player1); // Tile B2
        $this->tiles[5]->at($this->player2); // Tile B3
        $this->tiles[8]->at($this->player1); // Tile C3

        // Player1 sets A1, B2, C3
        $this->assertTrue($this->jury->check($this->player1));
        // Player2 sets A2, B3
        $this->assertFalse($this->jury->check($this->player2));
    }

    /** @test */
    public function it_checks_the_winner_of_game_expects_player1()
    {
        $this->tiles[0]->at($this->player1); // Tile A1
        $this->tiles[1]->at($this->player2); // Tile A2
        $this->tiles[4]->at($this->player1); // Tile B2
        $this->tiles[5]->at($this->player2); // Tile B3
        $this->tiles[8]->at($this->player1); // Tile C3

        // Player1 sets A1, B2, C3
        $this->assertEquals($this->jury->winner(), 'player1');
    }
}