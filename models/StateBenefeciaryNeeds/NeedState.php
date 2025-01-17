<?php

interface NeedState {
    public function handle(NeedBenefeciaryClass $need);
    public function moveBack(NeedBenefeciaryClass $need);
}
