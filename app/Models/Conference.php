<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
class Conference extends Eloquent
{
	
	protected  $table = "conference";
	protected $fillable = ['title','conference_by','conference_for','conference_date','conference_room_id','conference_type','is_available','created_at','updated_at'];
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