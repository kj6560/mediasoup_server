<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController
{
    // Show the product attributes based on the id.
	public function showAction(int $id, RouteCollection $routes)
	{
        $product = new Conference();
        print_r($product->read($id));

        require_once APP_ROOT . '/views/product.php';
	}
}