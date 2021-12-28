<?php

defined('BASEPATH') OR exit('No direct script access allowed');
    require_once dirname(__FILE__) . "/cryptobox/cryptobox.class.php";
    class Crypto extends Cryptobox {
        public function __construct() {
            parent::__construct();
        }
    }
?>