<?php 
namespace App\Models;
class Conference
{
	
    public function readConferences(){
        $conference = R::getAll(
            'SELECT * FROM conference');
        print_r($conference);
    }
	
}