<?php

namespace App\Core;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

#[\AllowDynamicProperties]
class CI_Controller extends BaseController
{
    /** @var CI3Loader */
    public $load;

    /** @var CI3DatabaseWrapper */
    public $db;

    /** @var CI3Input */
    public $input;

    /** @var CI3Session */
    public $session;

    /** @var CI3URI */
    public $uri;

    /** @var CI3Agent */
    public $agent;

    /** @var CI3Config */
    public $config;

    /** @var CI3Pagination */
    public $pagination;

    /** @var CI3FormValidation */
    public $form_validation;

    /** @var CI3Upload */
    public $upload;

    /** @var CI3ImageLib */
    public $image_lib;

    /** @var CI3Email */
    public $email;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        global $CI_INSTANCE;
        $CI_INSTANCE = $this;

        $this->load = new CI3Loader($this);
        $this->db = new CI3DatabaseWrapper();
        $this->input = new CI3Input();
        $this->session = new CI3Session();
        $this->uri = new CI3URI();
        $this->agent = new CI3Agent();
        $this->config = new CI3Config();
        $this->pagination = new CI3Pagination();
        $this->form_validation = new CI3FormValidation();
        $this->upload = new CI3Upload();
        $this->image_lib = new CI3ImageLib();
        $this->email = new CI3Email();

        // Autoload helpers (dari CI3 config/autoload.php)
        helper(['url', 'form', 'file', 'date', 'text']);

        // Autoload News_model (dari CI3 config/autoload.php)
        $this->load->model('News_model');
    }

    public function __construct()
    {
        global $CI_INSTANCE;
        $CI_INSTANCE = $this;

        $this->load = new CI3Loader($this);
        $this->db = new CI3DatabaseWrapper();
        $this->input = new CI3Input();
        $this->session = new CI3Session();
        $this->uri = new CI3URI();
        $this->agent = new CI3Agent();
        $this->config = new CI3Config();
        $this->pagination = new CI3Pagination();
        $this->form_validation = new CI3FormValidation();
        $this->upload = new CI3Upload();
        $this->image_lib = new CI3ImageLib();
        $this->email = new CI3Email();

        // Autoload helpers (dari CI3 config/autoload.php)
        helper(['url', 'form', 'file', 'date', 'text']);

        // Autoload News_model (dari CI3 config/autoload.php)
        $this->load->model('News_model');
    }

    public function __get(string $key)
    {
        // 1. Cek model di App\Models\<Key>
        $className = ucfirst($key);
        $namespaced = '\\App\\Models\\' . $className;
        if (class_exists($namespaced)) {
            $instance = new $namespaced();
            $this->{$key} = $instance;
            $this->{strtolower($key)} = $instance;
            return $instance;
        }

        // 2. Cek dengan suffix _model
        if (!str_ends_with(strtolower($key), '_model')) {
            $namespacedModel = '\\App\\Models\\' . $className . '_model';
            if (class_exists($namespacedModel)) {
                $instance = new $namespacedModel();
                $this->{$key} = $instance;
                return $instance;
            }
        }

        return null;
    }
}
