<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Session
{
    protected $session;

    public function __construct()
    {
        $this->session = service('session');
    }

    public function userdata(?string $item = null)
    {
        if ($item === null) {
            $sess = $this->session ? $this->session->get() : null;
            return is_array($sess) ? array_merge($_SESSION ?? [], $sess) : ($_SESSION ?? []);
        }
        if (isset($_SESSION[$item])) {
            return $_SESSION[$item];
        }
        return $this->session ? $this->session->get($item) : null;
    }

    public function set_userdata($data, $value = null): void
    {
        if (is_array($data)) {
            $this->session->set($data);
        } else {
            $this->session->set($data, $value);
        }
    }

    public function unset_userdata($key): void
    {
        $this->session->remove($key);
    }

    public function all_userdata(): array
    {
        return $this->session->get() ?? [];
    }

    public function has_userdata(string $item): bool
    {
        return $this->session->has($item);
    }

    public function sess_destroy(): void
    {
        $this->session->destroy();
    }

    public function sess_regenerate(bool $destroy = false): void
    {
        $this->session->regenerate($destroy);
    }

    public function keep_flashdata($key): void
    {
        $this->session->keepFlashdata($key);
    }

    public function set_flashdata($key, $value = null): void
    {
        $this->session->setFlashdata($key, $value);
    }

    public function flashdata(?string $key = null)
    {
        if ($key === null) {
            return $this->session->getFlashdata();
        }
        return $this->session->getFlashdata($key);
    }

    public function __call(string $name, array $args)
    {
        return $this->session->{$name}(...$args);
    }
}
