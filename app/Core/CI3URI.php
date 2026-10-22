<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3URI
{
    protected $request;

    public function __construct()
    {
        $this->request = service('request');
    }

    public function segment(int $n, $no_result = false)
    {
        $segments = $this->request->getUri()->getSegments();
        $idx = $n - 1;
        if (isset($segments[$idx])) {
            return $segments[$idx];
        }
        return $no_result;
    }

    public function rsegment(int $n, $no_result = false)
    {
        return $this->segment($n, $no_result);
    }

    public function total_segments(): int
    {
        return $this->request->getUri()->getTotalSegments();
    }

    public function uri_string(): string
    {
        return $this->request->getUri()->getPath();
    }

    public function segment_array(): array
    {
        return $this->request->getUri()->getSegments();
    }
}
