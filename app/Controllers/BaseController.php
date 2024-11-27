<?php

class BaseController
{
    public function addSuccessMessage($message)
    {
        $_SESSION['messages'][] = ['type' => 'success', 'message' => $message];
    }

    public function addDangerMessage($message)
    {
        $_SESSION['messages'][] = ['type' => 'danger', 'message' => $message];
    }

    public function addWarningMessage($message)
    {
        $_SESSION['messages'][] = ['type' => 'warning', 'message' => $message];
    }
}
