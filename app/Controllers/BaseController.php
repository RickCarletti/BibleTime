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

    function replaceEmptyStringsWithNull($data)
    {
        foreach ($data as $key => $value) {
            if (is_string($value) && trim($value) === '') {
                // Se o campo for uma string vazia ou apenas com espaços em branco, substitui por null
                $data[$key] = null;
            }
        }
        return $data;
    }
}
