<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Input
{
    protected $request;

    public function __construct()
    {
        $this->request = service('request');
    }

    public function post(?string $index = null, $xss_clean = null)
    {
        $val = ($index === null) ? $this->request->getPost() : $this->request->getPost($index);
        if ($xss_clean === true && $val !== null) {
            return $this->xss_clean($val);
        }
        return $val;
    }

    public function get(?string $index = null, $xss_clean = null)
    {
        $val = ($index === null) ? $this->request->getGet() : $this->request->getGet($index);
        if ($xss_clean === true && $val !== null) {
            return $this->xss_clean($val);
        }
        return $val;
    }

    public function get_post(string $index, $xss_clean = null)
    {
        $val = $this->post($index, $xss_clean);
        return ($val !== null) ? $val : $this->get($index, $xss_clean);
    }

    public function xss_clean($data)
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $data[$k] = $this->xss_clean($v);
            }
            return $data;
        }

        if (!is_string($data)) {
            return $data;
        }

        // Remove null bytes
        $data = str_replace(["\0", chr(0)], '', $data);

        // Remove invisible control characters
        $data = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $data);

        // Remove script tags and contents
        $data = preg_replace('#<script[^>]*>.*?</script>#is', '', $data);

        // Neutralize dangerous pseudo-protocols
        $data = preg_replace('#(javascript|vbscript|livescript|behavior|expression):#i', '$1 :', $data);

        // Neutralize HTML event handlers (onload, onerror, onclick, etc.)
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(on[a-z]+)(\s*=\s*)#iu', '$1data-$2$3', $data);

        // Neutralize dangerous embed / iframe tags
        $data = preg_replace('#<(iframe|object|embed|applet)[^>]*>.*?</\1>#is', '', $data);
        $data = preg_replace('#<(iframe|object|embed|applet)[^>]*>#is', '', $data);

        return $data;
    }

    public function cookie(?string $index = null, $xss_clean = null)
    {
        return $this->request->getCookie($index);
    }

    public function server(?string $index = null, $xss_clean = null)
    {
        return $this->request->getServer($index);
    }

    public function ip_address(): string
    {
        return (string) $this->request->getIPAddress();
    }

    public function user_agent(): string
    {
        return (string) $this->request->getUserAgent()->getAgentString();
    }

    public function is_ajax_request(): bool
    {
        return $this->request->isAJAX();
    }

    public function method(bool $upper = false): string
    {
        $method = $this->request->getMethod();
        return $upper ? strtoupper($method) : strtolower($method);
    }
}
