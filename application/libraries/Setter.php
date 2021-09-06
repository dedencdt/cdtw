<?php

class Setter
{

    protected $ci;
    // ===========
    // central codtech Configuration
    // ===========
    private $wc_baseurl = 'http://localhost/web/', //Masukan Base URL Woocommerce di LP
        $wc_ck = 'ck_5f9468a7490d206304ce008a70abaa9e22e9cc62', // Woocommerce Customer Key
        $wc_sk = 'cs_5c000d81e1769273c5ede0ba2286fb47b73379a1'; //Secret Key

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function get_apiwc_url()
    {
        return $this->wc_baseurl;
    }

    function get_apiwc_ck()
    {
        return $this->wc_ck;
    }

    function get_apiwc_sk()
    {
        return $this->wc_sk;
    }
}
