<?php
require "mvc/Database.php";
class Conference extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select()
    {

        echo "reached here";
    }
}
