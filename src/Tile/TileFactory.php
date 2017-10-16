<?php

namespace Schellingerht\TicTacToe\Tile;

/**
 * Class TileFactory
 *
 * Logic about creating a tile
 *
 * @package Schellingerht\TicTacToe\Tile
 */
final class TileFactory
{
    /**
     * @var string Type of tile
     */
    private $type;

    /**
     * TileFactory constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Create an instance of the given the tile type
     *
     * @param int $row
     * @param int $col
     * @return TileInterface
     */
    public function create(int $row, int $col): TileInterface
    {
        /**
         * @ToDo Exception handling if the simple type does not exist
         */
        $class =  __NAMESPACE__ . '\\' . $this->type;
        return new $class($row, $col);
    }
}