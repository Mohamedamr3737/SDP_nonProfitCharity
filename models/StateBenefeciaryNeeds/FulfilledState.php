<?php

require_once 'NeedState.php';

class FulfilledState implements NeedState {
    public function handle(NeedBenefeciaryClass $need) {
        echo "Need is fulfilled. No further actions required.\n";
    }

    public function moveBack(NeedBenefeciaryClass $need) {
        echo "Moving back to approved state.\n";
        $need->setState(new ApprovedState());
    }
}
