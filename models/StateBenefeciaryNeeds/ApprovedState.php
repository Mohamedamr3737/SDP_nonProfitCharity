<?php

require_once 'NeedState.php';

class ApprovedState implements NeedState {
    public function handle(NeedBenefeciaryClass $need) {
        echo "Need is approved. Fulfilling the need.\n";
        $need->setState(new FulfilledState());
    }

    public function moveBack(NeedBenefeciaryClass $need) {
        echo "Moving back to requested state.\n";
        $need->setState(new RequestedState());
    }
}
