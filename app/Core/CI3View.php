<?php

namespace App\Core;

use CodeIgniter\View\View;
use Config\Paths;
use Config\View as ViewConfig;

#[\AllowDynamicProperties]
class CI3View extends View
{
    public function __get(string $key)
    {
        // 1. Check data passed to view
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        // 2. Delegate to controller instance / get_instance()
        $ci = get_instance();
        if ($ci) {
            if (isset($ci->{$key})) {
                return $ci->{$key};
            }
            $prop = $ci->{$key};
            if ($prop !== null) {
                return $prop;
            }
        }

        // 3. Fallback core services if not set on controller
        switch ($key) {
            case 'session':
                return new CI3Session();
            case 'uri':
                return new CI3URI();
            case 'input':
                return new CI3Input();
            case 'db':
                return new CI3DatabaseWrapper();
            case 'config':
                return new CI3Config();
            case 'form_validation':
                return new CI3FormValidation();
            case 'upload':
                return new CI3Upload();
            case 'image_lib':
                return new CI3ImageLib();
        }

        // 4. Check for model name
        $className = ucfirst($key);
        $modelClass = '\\App\\Models\\' . $className;
        if (class_exists($modelClass)) {
            $inst = new $modelClass();
            if ($ci) {
                $ci->{$key} = $inst;
            }
            return $inst;
        }

        return null;
    }

    public function __call(string $name, array $arguments)
    {
        $ci = get_instance();
        if (method_exists($ci, $name)) {
            return $ci->{$name}(...$arguments);
        }
        return null;
    }
}
