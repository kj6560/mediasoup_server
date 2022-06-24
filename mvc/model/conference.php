<?php
require "mvc/Database.php";
class Conference extends Database
{
    public function __construct()
    {
        echo "here";
        parent::__construct();
    }
}
