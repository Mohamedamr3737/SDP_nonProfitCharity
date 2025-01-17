<?php

class EventIterator implements \Iterator {
    private array $events;
    private int $position = 0;

    public function __construct(array $events) {
        $this->events = $events;
    }

    public function current(): mixed {
        return $this->events[$this->position];
    }

    public function key(): int {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function valid(): bool {
        return isset($this->events[$this->position]);
    }
}
