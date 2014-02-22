<?php

namespace ch\aeberhardo\validators;

use \Laravel\Messages;
use \Exception;

class ValidationException extends Exception {

    /**
     * @var Messages
     */
    private $validationMessages;

    /**
     * @param Messages|string $mixed
     */
    public function __construct($mixed) {

        if ($mixed instanceof Messages) {
            $this->fromMessages($mixed);
            
        } else if (is_string($mixed)) {
            $this->fromString($mixed);
            
        } else {
            throw new Exception('Constructur arguments must be one of Messages|string.');
        }
    }

    private function fromMessages(Messages $messages) {
        parent::__construct($messages->first());
        $this->validationMessages = $messages;
    }

    private function fromString($string) {
        parent::__construct($string);
        $messages = new Messages();
        $messages->add('message', $string);
        $this->validationMessages = $messages;
    }

    /**
     * @return Messages
     */
    public function getValidationMessages() {
        return $this->validationMessages;
    }

}