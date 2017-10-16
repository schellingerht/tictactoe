<?php

namespace Schellingerht\TicTacToe\Tile;

use Schellingerht\TicTacToe\Player\PlayerInterface;
use SplObserver;
use SplSubject;

/**
 * Class SimpleTile
 *
 * Logic about the tile/field, his position and incoming player
 *
 * @package Schellingerht\TicTacToe\Tile
 */
final class SimpleTile implements TileInterface, SplSubject
{
    /**
     * @var int $row Name of the row
     */
    private $row;

    /**
     * @var int $col Name of the col
     */
    private $col;

    /**
     * @var array[SplObserver] $observers
     */

    private $observers;

    /**
     * @var PlayerInterface|null $player
     */
    private $player;

    /**
     * Tile constructor
     *
     * @param int $row
     * @param int $col
     */
    public function __construct(int $row, int $col)
    {
        $this->row = $row;
        $this->col = $col;
        $this->observers = [];
    }

    /**
     * @inheritdoc
     */
    public function at(PlayerInterface $player): void
    {
        $this->player = $player;
        $this->notify();
    }

    /**
     * @inheritdoc
     */
    public function tile(): object
    {
        return (object) [
            'row' => $this->row,
            'col' => $this->col,
            'player' => $this->player
        ];
    }

    /**
     * Attach the given observer
     *
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    /**
     * Detach the given observer
     *
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer): void
    {
        $this->observers = array_diff($this->observers, [$observer]);
    }

    /**
     * Notify the attachted observers
     */
    public function notify(): void
    {
        array_walk($this->observers, function ($observer) {
            /**
             * @var SplObserver $observer
             */
            $observer->update($this);
        });
    }
}