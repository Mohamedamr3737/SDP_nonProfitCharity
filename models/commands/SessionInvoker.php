<?php
class SessionInvoker {
    public function __construct() {
        if (!isset($_SESSION['undo_stack'])) {
            $_SESSION['undo_stack'] = [];
        }
        if (!isset($_SESSION['redo_stack'])) {
            $_SESSION['redo_stack'] = [];
        }
    }

    public function execute(Command $command) {
        $command->execute();
        $_SESSION['undo_stack'][] = serialize($command);
        $_SESSION['redo_stack'] = []; // Clear redo stack on a new action
    }

    public function undo() {
        if (!empty($_SESSION['undo_stack'])) {
            $serializedCommand = array_pop($_SESSION['undo_stack']);
            $command = unserialize($serializedCommand);
            $command->undo();
            $_SESSION['redo_stack'][] = $serializedCommand;
        }
    }

    public function redo() {
        if (!empty($_SESSION['redo_stack'])) {
            $serializedCommand = array_pop($_SESSION['redo_stack']);
            $command = unserialize($serializedCommand);
            $command->execute();
            $_SESSION['undo_stack'][] = $serializedCommand;
        }
    }
}
?>
