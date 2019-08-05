<?php

use Rain\Tpl;

class Page
{
    private $tpl;

    /**
     * When a new instance of Page is created, the TPL is configured
     * and the header.html is called
     */
    public function __construct()
    {
        $config = [
            'tpl_dir' => $_SERVER['DOCUMENT_ROOT'] . '/allblacks-ecommerce/resources/views/',
            'cache_dir' => $_SERVER['DOCUMENT_ROOT'] . '/allblacks-ecommerce/resources/views-cache/',
            'debug' => false
        ];

        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->tpl->draw('header');
    }

    private function setData($data = [])
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    /**
     * Renders a view template
     * @param string $name the name of the templante
     * @param array $data and associative array with the data to pass to the view template
     * 
     * @return mixed return the template rendered
     */
    public function view($name, $data = [])
    {
        $this->setData($data);
        return $this->tpl->draw($name);
    }

    /**
     * When the object is destructed, the footer is rendered
     */
    public function __destruct()
    {
        $this->tpl->draw('footer');
    }
}
