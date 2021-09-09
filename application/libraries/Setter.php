<?php

class Setter
{

    protected $ci;
    // ===========
    // central codtech Configuration
    // ===========
    private $wc_baseurl = 'http://localhost/web/', //Masukan Base URL Woocommerce di LP
        $wc_ck = 'ck_5f9468a7490d206304ce008a70abaa9e22e9cc62', // Woocommerce Customer Key
        $wc_sk = 'cs_5c000d81e1769273c5ede0ba2286fb47b73379a1', //Secret Key

        // CONFIGURASI UNTUK TELEGRAM
        $telegram_id = '-518394360', // chat_id
        $message_text = '',
        $secret_token = '1834154742:AAGns_SHoe74sFThU3Y43gtI96VY2aG9UxI';




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

    // get api for telegram
    function get_chat_id_tele()
    {
        return $this->telegram_id;
    }

    function get_message_tele()
    {
        return $this->message_text;
    }

    function get_sctoke_tele()
    {
        return $this->secret_token;
    }
}
