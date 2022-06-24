<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Conference extends Eloquent
{
	
	protected  $table = "conference";
	public $id,$title,$conference_by,$conference_for,$conference_date,$conference_room_id,$conference_type,$created_at,$updated_at,$is_available;
    // CRUD OPERATIONS
	public function create(array $data)
	{
		
	}
	
	public function read(int $id)
	{
		$data = Conference::all();

		return $data;
	}
	
	
}