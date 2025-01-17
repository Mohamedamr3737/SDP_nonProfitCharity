<?php

require_once 'NeedState.php';

class RequestedState implements NeedState {
    public function handle(NeedBenefeciaryClass $need) {
        echo "Need is requested. Approving the need.\n";
        $need->setState(new ApprovedState());
    }

    public function moveBack(NeedBenefeciaryClass $need) {
        echo "Cannot move back from the requested state.\n";
    }
}
