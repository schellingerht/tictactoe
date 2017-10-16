<?php

namespace Schellingerht\TicTacToe\Jury;

use Schellingerht\TicTacToe\Player\PlayerInterface;
use SplObserver;
use SplSubject;

/**
 * Class SimpleJury
 *
 * Logic about the jury: check which player wins
 *
 * @package Schellingerht\TicTacToe\Jury
 */
class SimpleJury implements JuryInterface, SplObserver
{
    /**
     * @var array[][] $rows
     */
    private $rows;

    /**
     * @var array[][] $cols
     */
    private $cols;

    /**
     * @var PlayerInterface[] $players
     */
    private $players;

    /**
     * @var int $size
     */
    private $size;

    /**
     * Result constructor.
     *
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @param PlayerInterface $player
     *
     * @return bool
     */
    public function check(PlayerInterface $player): bool
    {
        list($uniqueRows, $uniqueCols) = $this->uniqueItemsByPlayer($player);

        return
            ($uniqueRows === 1 && $uniqueCols === $this->size) ||
            ($uniqueRows === $this->size && $uniqueCols === $this->size) ||
            ($uniqueRows === $this->size && $uniqueCols === 1);
    }

    /**
     * @param PlayerInterface $player
     *
     * @return array
     */
    private function uniqueItemsByPlayer(PlayerInterface $player): array
    {
        return [
            count(array_unique($this->rows[$player->name()])),
            count(array_unique($this->cols[$player->name()]))
        ];
    }

    /**
     * @inheritdoc
     */
    public function winner(): string
    {
        foreach ($this->players as $player) {
            /**
             * @var PlayerInterface $player
             */
            if ($this->check($player)) {
                return $player->name();
            }
        }
        return 'Nobody';
    }

    /**
     * Called by SplSubject notify
     *
     * @param SplSubject $tile
     */
    public function update(SplSubject $tile): void
    {
        /**
         * @var object $tile
         */
        $tile = $tile->tile();
        $this->rows[$tile->player->name()][] = $tile->row;
        $this->cols[$tile->player->name()][] = $tile->col;
        $this->players[] = $tile->player;
    }
}