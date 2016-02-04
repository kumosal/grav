<?php
namespace Grav\Common\Data;

use Grav\Common\Grav;

class ValidationException extends \RuntimeException
{
    protected $messages = [];

    public function setMessages(array $messages = []) {
        $this->messages = $messages;

        $language = Grav::instance()['language'];
        $this->message = $language->translate('FORM.VALIDATION_FAIL', null, true) . ' ' . $this->message;

        foreach ($messages as $variable => &$list) {
            $list = array_unique($list);
            foreach ($list as $message) {
                $this->message .= "<br/>$message";
            }
        }

        return $this;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}