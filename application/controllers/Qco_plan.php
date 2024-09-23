<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qco_plan extends MY_Controller
{

    private $db_kis = "";
    function __construct()
    {
        parent::__construct();
		$this->is_logedin();
		$this->lang->load('auth');
    }
    



}