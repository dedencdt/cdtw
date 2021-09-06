<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Linkreff extends CI_Controller
{

    public function index()
    {
        print_r($_SERVER['REQUEST_URI']);
    }
}
