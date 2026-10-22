<?php

namespace App\Core;

#[\AllowDynamicProperties]
class CI3Pagination
{
    public string $base_url = '';
    public int $total_rows = 0;
    public int $per_page = 10;
    public int $num_links = 2;
    public int $cur_page = 0;
    public int $uri_segment = 3;

    public string $full_tag_open = '<ul class="pagination">';
    public string $full_tag_close = '</ul>';
    public string $first_link = '&lsaquo; First';
    public string $first_tag_open = '<li>';
    public string $first_tag_close = '</li>';
    public string $last_link = 'Last &rsaquo;';
    public string $last_tag_open = '<li>';
    public string $last_tag_close = '</li>';
    public string $next_link = '&gt;';
    public string $next_tag_open = '<li>';
    public string $next_tag_close = '</li>';
    public string $prev_link = '&lt;';
    public string $prev_tag_open = '<li>';
    public string $prev_tag_close = '</li>';
    public string $cur_tag_open = '<li class="active"><span>';
    public string $cur_tag_close = '</span></li>';
    public string $num_tag_open = '<li>';
    public string $num_tag_close = '</li>';

    public function initialize(array $params = []): void
    {
        foreach ($params as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    public function create_links(): string
    {
        if ($this->total_rows === 0 || $this->per_page === 0) {
            return '';
        }

        $num_pages = (int) ceil($this->total_rows / $this->per_page);
        if ($num_pages === 1) {
            return '';
        }

        // Determine current page from URI
        $request = service('request');
        $segments = $request->getUri()->getSegments();
        $idx = $this->uri_segment - 1;
        $offset = isset($segments[$idx]) ? (int) $segments[$idx] : 0;
        $this->cur_page = (int) floor($offset / $this->per_page) + 1;
        if ($this->cur_page < 1) {
            $this->cur_page = 1;
        }

        $output = '';
        $output .= $this->full_tag_open;

        $baseUrl = rtrim($this->base_url, '/') . '/';

        // First link
        if ($this->cur_page > 1) {
            $output .= $this->first_tag_open . '<a href="' . $baseUrl . '0">' . $this->first_link . '</a>' . $this->first_tag_close;
            $prevOffset = max(0, ($this->cur_page - 2) * $this->per_page);
            $output .= $this->prev_tag_open . '<a href="' . $baseUrl . $prevOffset . '">' . $this->prev_link . '</a>' . $this->prev_tag_close;
        }

        $start = max(1, $this->cur_page - $this->num_links);
        $end = min($num_pages, $this->cur_page + $this->num_links);

        for ($i = $start; $i <= $end; $i++) {
            $pageOffset = ($i - 1) * $this->per_page;
            if ($i === $this->cur_page) {
                $output .= $this->cur_tag_open . $i . $this->cur_tag_close;
            } else {
                $output .= $this->num_tag_open . '<a href="' . $baseUrl . $pageOffset . '">' . $i . '</a>' . $this->num_tag_close;
            }
        }

        // Next / Last
        if ($this->cur_page < $num_pages) {
            $nextOffset = $this->cur_page * $this->per_page;
            $output .= $this->next_tag_open . '<a href="' . $baseUrl . $nextOffset . '">' . $this->next_link . '</a>' . $this->next_tag_close;
            $lastOffset = ($num_pages - 1) * $this->per_page;
            $output .= $this->last_tag_open . '<a href="' . $baseUrl . $lastOffset . '">' . $this->last_link . '</a>' . $this->last_tag_close;
        }

        $output .= $this->full_tag_close;
        return $output;
    }
}
