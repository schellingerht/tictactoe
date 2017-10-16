<?php

namespace Schellingerht\TicTacToe;

use Exception;
use Schellingerht\TicTacToe\Jury\JuryInterface;
use Schellingerht\TicTacToe\Tile\TileFactory;
use SplObserver;
use SplSubject;

/**
 * Class GameField
 *
 * Logic to set up the game field with tiles
 *
 * @package Schellingerht\TicTacToe
 */
final class GameField
{
    /**
     * @var int Size (width or height) of the game field (number of tiles)
     */
    private $size;

    /**
     * @var JuryInterface Implementation of the jury (why should who win?)
     */
    private $jury;

    /**
     * @var TileFactory Factory for creating a specific type Tile
     */
    private $tileFactory;

    /**
     * GameField constructor
     *
     * @param int $size (Width or height) of the game field (number of tiles)
     * @param string $tileType Type of tile
     * @param SplObserver $jury Instance of jury which implements SplObserver (and JuryInterface)
     */
    public function __construct(int $size, string $tileType, SplObserver $jury)
    {
        $this->size = $size;
        $this->jury = $jury;
        $this->tileFactory = new tileFactory($tileType);
    }

    /**
     * Set up gamefield with tiles. Attach jury instance to field
     *
     * @return array Tiles
     * @throws Exception
     */
    public function tiles(): array
    {
        if (!($this->jury instanceof JuryInterface)) {
            throw new Exception('No valid jury implementation specified');
        }

        $tiles = [];
        for ($i = 1; $i <= $this->size; $i++) {
            for ($j = 1; $j <= $this->size; $j++) {
                /**
                 * @var SplSubject $tile
                 */
                $tile = $tiles[] = $this->tileFactory->create($i, $j);
                $tile->attach($this->jury);
            }
        }
        return $tiles;
    }
}