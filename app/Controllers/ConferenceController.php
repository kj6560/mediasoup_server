<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
use Illuminate\Support\Facades\DB;
class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        
        $this->loadView('general_layout','conference/product',array("conference"=>array()));
	}
}