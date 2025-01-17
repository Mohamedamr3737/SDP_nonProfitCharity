<?php

require_once 'NeedState.php';

class CancelledState implements NeedState {
    public function handle(NeedBenefeciaryClass $need) {
        echo "Need is cancelled. No further actions possible.\n";
    }

    public function moveBack(NeedBenefeciaryClass $need) {
        echo "Cannot move back from the cancelled state.\n";
    }
}
