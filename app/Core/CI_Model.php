<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI_Model
{
    /** @var CI3DatabaseWrapper */
    public $db;

    public function __construct()
    {
        $this->db = new CI3DatabaseWrapper();
    }

    public function __get(string $key)
    {
        if ($key === 'db') {
            return $this->db;
        }

        $ci = get_instance();
        if ($ci && isset($ci->{$key})) {
            return $ci->{$key};
        }

        switch ($key) {
            case 'config':
                return new CI3Config();
            case 'session':
                return new CI3Session();
            case 'input':
                return new CI3Input();
            case 'uri':
                return new CI3URI();
            case 'agent':
                return new CI3Agent();
            case 'pagination':
                return new CI3Pagination();
            case 'form_validation':
                return new CI3FormValidation();
            case 'upload':
                return new CI3Upload();
            case 'image_lib':
                return new CI3ImageLib();
            case 'email':
                return new CI3Email();
            default:
                return null;
        }
    }
}
