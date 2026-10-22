<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('activate_menu')) {
    function activate_menu(string $controller): string
    {
        $router = service('router');
        $class = class_basename($router->controllerName() ?? '');
        return (strcasecmp($class, $controller) === 0) ? 'active' : '';
    }
}

if (!function_exists('redirect')) {
    function redirect($uri = '', $method = 'auto', $code = null)
    {
        if ($uri === null || $uri === '') {
            $uri = base_url();
        } elseif (!preg_match('#^https?://#i', $uri)) {
            $uri = site_url($uri);
        }
        header('Location: ' . $uri, true, $code ?: 302);
        exit();
    }
}

if (!function_exists('anchor')) {
    function anchor($uri = '', string $title = '', $attributes = '', $altConfig = null): string
    {
        $config = ($altConfig instanceof \Config\App) ? $altConfig : config(\Config\App::class);

        $siteUrl = is_array($uri) ? site_url($uri, null, $config) : (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri, null, $config));
        $siteUrl = rtrim($siteUrl, '/');

        if ($title === '') {
            $title = $siteUrl;
        }

        if ($attributes !== '') {
            $attributes = stringify_attributes($attributes);
        }

        // Support legacy calls where 4th argument is an additional attribute string like onclick="..."
        if (is_string($altConfig) && $altConfig !== '') {
            $attributes .= ' ' . trim($altConfig);
        }

        return '<a href="' . $siteUrl . '"' . $attributes . '>' . $title . '</a>';
    }
}

if (!function_exists('xml_convert')) {
    function xml_convert(string $str, bool $protect_all = false): string
    {
        $temp = '__TEMP_AMPERSANDS__';
        $str = preg_replace('/&#(\d+);/', $temp . '\\1;', $str);
        if ($protect_all === true) {
            $str = preg_replace([
                '/&(?!(?:[a-zA-Z0-9]+|#[0-9]+|#x[0-9a-fA-F]+);)/',
                '/<([a-zA-Z0-9\/]+)/',
                '/>/',
            ], ['&amp;', '&lt;\\1', '&gt;'], $str);
        } else {
            $str = htmlspecialchars($str, ENT_QUOTES | ENT_XML1, 'UTF-8');
        }
        return str_replace($temp, '&#', $str);
    }
}

if (!function_exists('config_item')) {
    function config_item(string $item)
    {
        $app = config('App');
        return $app->{$item} ?? null;
    }
}

if (!function_exists('string_limit_words')) {
    function string_limit_words($string, $word_limit) {
        $words = explode(' ', (string) $string);
        return implode(' ', array_slice($words, 0, (int) $word_limit));
    }
}

if (!function_exists('getBulan')) {
    function getBulan($bln) {
        switch ((int) $bln) {
            case 1: return "Januari";
            case 2: return "Februari";
            case 3: return "Maret";
            case 4: return "April";
            case 5: return "Mei";
            case 6: return "Juni";
            case 7: return "Juli";
            case 8: return "Agustus";
            case 9: return "September";
            case 10: return "Oktober";
            case 11: return "November";
            case 12: return "Desember";
            default: return "";
        }
    }
}

if (!function_exists('getBulan2')) {
    function getBulan2($bln) {
        switch ((int) $bln) {
            case 1: return "Jan";
            case 2: return "Feb";
            case 3: return "Mar";
            case 4: return "Apr";
            case 5: return "Mei";
            case 6: return "Jun";
            case 7: return "Jul";
            case 8: return "Agu";
            case 9: return "Sep";
            case 10: return "Okt";
            case 11: return "Nov";
            case 12: return "Des";
            default: return "";
        }
    }
}

if (!function_exists('tgl_indo')) {
    function tgl_indo($tgl1) {
        if (!$tgl1) return "";
        $tanggal = substr($tgl1, 8, 2);
        $bln = (int) substr($tgl1, 5, 2);
        $bulan = getBulan($bln);
        $tahun = substr($tgl1, 0, 4);

        $time = strtotime($tgl1);
        $nama = $time ? date("l", $time) : "";
        $hariMap = [
            "Sunday" => "Minggu",
            "Monday" => "Senin",
            "Tuesday" => "Selasa",
            "Wednesday" => "Rabu",
            "Thursday" => "Kamis",
            "Friday" => "Jumat",
            "Saturday" => "Sabtu",
        ];
        $nama_hari = $hariMap[$nama] ?? "";
        return $nama_hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('tgl_indo2')) {
    function tgl_indo2($tgl1) {
        if (!$tgl1) return "";
        $tanggal = substr($tgl1, 8, 2);
        $bln = (int) substr($tgl1, 5, 2);
        $bulan = getBulan($bln);
        $tahun = substr($tgl1, 0, 4);
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('tcpdf')) {
    function tcpdf(): void
    {
        if (!class_exists('TCPDF')) {
            $file = VENDORPATH . 'tecnickcom/tcpdf/tcpdf.php';
            if (file_exists($file)) {
                require_once $file;
            }
        }
        if (class_exists('TCPDF') && !class_exists('App\Controllers\TCPDF')) {
            class_alias('TCPDF', 'App\Controllers\TCPDF');
        }
    }
}

if (!function_exists('mdate')) {
    function mdate(string $datestr = '', $time = '')
    {
        if ($datestr === '') {
            return '';
        }
        if ($time === '' || $time === null) {
            $time = time();
        } elseif (is_string($time) && !is_numeric($time)) {
            $time = strtotime($time) ?: time();
        }
        $datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
        return date($datestr, (int) $time);
    }
}

if (!function_exists('now')) {
    function now(?string $timezone = null): int
    {
        return time();
    }
}

if (!function_exists('get_instance')) {
    function get_instance()
    {
        global $CI_INSTANCE;
        if (!isset($CI_INSTANCE) || $CI_INSTANCE === null) {
            if (class_exists('\\App\\Core\\CI_Controller')) {
                $CI_INSTANCE = new \App\Core\CI_Controller();
            }
        }
        return $CI_INSTANCE ?? null;
    }
}

spl_autoload_register(function ($class) {
    if ($class === 'CI_Controller') {
        require_once APPPATH . 'Core/CI_Controller.php';
        if (!class_exists('CI_Controller', false)) {
            class_alias(\App\Core\CI_Controller::class, 'CI_Controller');
        }
    } elseif ($class === 'CI_Model') {
        require_once APPPATH . 'Core/CI_Model.php';
        if (!class_exists('CI_Model', false)) {
            class_alias(\App\Core\CI_Model::class, 'CI_Model');
        }
    }
});

if (!function_exists('_get_validation_object')) {
    function &_get_validation_object()
    {
        $ci = function_exists('get_instance') ? get_instance() : null;
        if ($ci && isset($ci->form_validation) && is_object($ci->form_validation)) {
            return $ci->form_validation;
        }
        $false = false;
        return $false;
    }
}

if (!function_exists('form_error')) {
    function form_error(string $field = '', string $prefix = '', string $suffix = ''): string
    {
        if ($field === '') {
            return '';
        }

        $message = '';

        // 1. Cek dari controller aktif CI3FormValidation
        $ci = function_exists('get_instance') ? get_instance() : null;
        if ($ci && isset($ci->form_validation) && is_object($ci->form_validation)) {
            $err = $ci->form_validation->error($field, $prefix, $suffix);
            if (!empty($err)) {
                return $err;
            }
        }

        // 2. Cek dari CodeIgniter 4 Validation Service
        if (class_exists(\Config\Services::class)) {
            $validation = \Config\Services::validation();
            if ($validation->hasError($field)) {
                $message = $validation->getError($field);
            }
        }

        // 3. Cek dari session flash validation
        if ($message === '' && function_exists('session')) {
            $sessionErrors = session('_ci_validation_errors');
            if (is_array($sessionErrors) && isset($sessionErrors[$field])) {
                $message = (string) $sessionErrors[$field];
            }
        }

        if ($message === '') {
            return '';
        }

        if ($prefix !== '' || $suffix !== '') {
            return $prefix . strip_tags($message) . $suffix;
        }

        return '<span class="text-danger" style="color:red; font-size:12px;">' . strip_tags($message) . '</span>';
    }
}

if (!function_exists('set_value')) {
    function set_value(string $field, $default = '', bool $htmlEscape = true): array|string
    {
        $request = service('request');

        $value = $request->getOldInput($field);
        if ($value === null) {
            $value = $request->getPost($field) ?? $default;
        }

        if ($value === null) {
            return '';
        }

        if (is_array($value)) {
            return $value;
        }

        return $htmlEscape ? esc((string) $value) : (string) $value;
    }
}




