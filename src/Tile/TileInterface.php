<?php

namespace Schellingerht\TicTacToe\Tile;
use Schellingerht\TicTacToe\Player\PlayerInterface;

/**
 * Interface TileInterface
 *
 * Tile logic
 *
 * @package Schellingerht\TicTacToe\Tile
 */
interface TileInterface
{
    /**
     * Handle player at tile
     *
     * @param PlayerInterface $player
     */
    public function at(PlayerInterface $player): void;

    /**
     * Get object with tile info (row, col, player)
     *
     * @return object
     */
    public function tile(): object;
}