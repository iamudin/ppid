<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Loader
{
    /** @var object */
    protected $caller;

    public function __construct(object $caller)
    {
        $this->caller = $caller;
    }

    public function model(string $model, ?string $name = null, $db_conn = false): self
    {
        $name = $name ?: $model;
        $cleanModel = basename(str_replace('\\', '/', $model));
        $className = ucfirst($cleanModel);

        // Try App\Models\<ClassName>
        $namespaced = '\\App\\Models\\' . $className;
        if (class_exists($namespaced)) {
            $instance = new $namespaced();
        } elseif (class_exists($className)) {
            $instance = new $className();
        } else {
            // Check in app/Models/<cleanModel>.php
            $paths = [
                APPPATH . 'Models/' . $cleanModel . '.php',
                APPPATH . 'Models/' . strtolower($cleanModel) . '.php',
                APPPATH . 'Models/' . ucfirst($cleanModel) . '.php',
            ];
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    require_once $path;
                    break;
                }
            }
            if (class_exists($namespaced)) {
                $instance = new $namespaced();
            } elseif (class_exists($className)) {
                $instance = new $className();
            } else {
                // Fallback generic CI_Model
                $instance = new CI_Model();
            }
        }

        $this->caller->{$name} = $instance;
        $this->caller->{strtolower($name)} = $instance;
        return $this;
    }

    protected array $cached_vars = [];

    public function vars($vars, $val = ''): self
    {
        if (is_string($vars)) {
            $vars = [$vars => $val];
        }
        $this->cached_vars = array_merge($this->cached_vars, (array) $vars);
        return $this;
    }

    public function get_var(string $key)
    {
        return $this->cached_vars[$key] ?? null;
    }

    public function get_vars(): array
    {
        return $this->cached_vars;
    }

    public function view(string $view, array $vars = [], bool $return = false)
    {
        // Strip .php if provided
        if (str_ends_with($view, '.php')) {
            $view = substr($view, 0, -4);
        }

        $allVars = array_merge($this->cached_vars, $vars);
        $output = view($view, $allVars);
        if ($return) {
            return $output;
        }

        echo $output;
        return $output;
    }

    public function helper($helpers): self
    {
        helper($helpers);
        return $this;
    }

    public function library(string $library, $params = null, ?string $object_name = null): self
    {
        $name = $object_name ?: strtolower($library);
        switch (strtolower($library)) {
            case 'session':
                $this->caller->{$name} = new CI3Session();
                break;
            case 'pagination':
                $this->caller->{$name} = new CI3Pagination();
                break;
            case 'user_agent':
                $this->caller->agent = new CI3Agent();
                $this->caller->{$name} = $this->caller->agent;
                break;
            case 'form_validation':
                $this->caller->{$name} = new CI3FormValidation();
                break;
            case 'upload':
                if (!isset($this->caller->{$name}) || !($this->caller->{$name} instanceof CI3Upload)) {
                    $this->caller->{$name} = new CI3Upload((array) ($params ?: []));
                } elseif (!empty($params)) {
                    $this->caller->{$name}->initialize((array) $params);
                }
                break;
            case 'image_lib':
                if (!isset($this->caller->{$name}) || !($this->caller->{$name} instanceof CI3ImageLib)) {
                    $this->caller->{$name} = new CI3ImageLib((array) ($params ?: []));
                } elseif (!empty($params)) {
                    $this->caller->{$name}->initialize((array) $params);
                }
                break;
            case 'email':
                if (!isset($this->caller->{$name}) || !($this->caller->{$name} instanceof CI3Email)) {
                    $this->caller->{$name} = new CI3Email((array) ($params ?: []));
                } elseif (!empty($params)) {
                    $this->caller->{$name}->initialize((array) $params);
                }
                break;
            default:
                if (!isset($this->caller->{$name})) {
                    $this->caller->{$name} = new \stdClass();
                }
                break;
        }
        return $this;
    }

    public function database($params = '', bool $return = false, ?bool $query_builder = null)
    {
        if ($return) {
            return new CI3DatabaseWrapper();
        }
        $this->caller->db = new CI3DatabaseWrapper();
        return $this->caller->db;
    }
}
