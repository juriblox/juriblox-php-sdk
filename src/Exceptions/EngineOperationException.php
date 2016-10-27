<?php

namespace JuriBlox\Sdk\Exceptions;

class EngineOperationException extends \Exception
{
    /**
     * @var array
     */
    private $errors;

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}
