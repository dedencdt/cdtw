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

        // CONFIGURASI UNTUK TELEGRAM CS NOTIF
        $telegram_id = '-518394360', // chat_id
        $message_text = '',
        $secret_token = '1834154742:AAGns_SHoe74sFThU3Y43gtI96VY2aG9UxI',

        // CONFIGURASI UNTUK TELEGRAM NOTIF FOR ADMIN
        $tele_id = '-1001471937777', // chat_id
        $tele_text = '',
        $tele_token = '2055110738:AAHeUlt9cWKeGFwRDa2DF81m6RLpks67GuE';






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


    // KONFIGURASI UNTUK TELE ADMIN
    function get_idteleadmin()
    {
        return $this->tele_id;
    }
    function get_tokenteleadmin()
    {
        return $this->tele_token;
    }
}
