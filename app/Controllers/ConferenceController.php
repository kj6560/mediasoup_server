<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
use Illuminate\Support\Facades\DB;
class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
        $conference = new Conference();
        $this->loadView('general_layout','conference/product',array("conference"=>$conference));
	}
}