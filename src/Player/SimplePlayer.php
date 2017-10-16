<?php

namespace Schellingerht\TicTacToe\Player;

/**
 * Class SimplePlayer
 *
 * Implementation of PlayerInterface
 *
 * @package Schellingerht\TicTacToe\Player
 */
final class SimplePlayer implements PlayerInterface
{
    /**
     * @var string Name of the player
     */
    private $name;

    /**
     * @inheritdoc
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function name(): string
    {
        return $this->name;
    }
}