<?php 
namespace App\Models;

class Conference
{
	

    // CRUD OPERATIONS
	public function create(array $data)
	{
		
	}
	
	public function read(int $id)
	{
		$this->title = 'My first Product';
		$this->description = 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum ';
		$this->price = 2.56;
		$this->sku = 'MVC-SP-PHP-01';
		$this->image = 'https://via.placeholder.com/150';

		return $this;
	}
	
	public function update(int $id, array $data)
	{
		
	}
	
	public function delete(int $id)
	{
		
	}
}