<?php

namespace Schellingerht\TicTacToe\Player;

/**
 * Interface PlayerInterface
 *
 * Player logic
 *
 * @package Schellingerht\TicTacToe
 */
interface PlayerInterface
{
    /**
     * Get the name of the player
     *
     * @return string
     */
    public function name(): string;
}