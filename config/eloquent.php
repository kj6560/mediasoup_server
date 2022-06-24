<?php 

use Illuminate\Database\Capsule\Manager as Capsule;

$Capsule = new Capsule;
$Capsule->addConnection([
   "driver" => "mysql",
   "host" =>"54.70.129.232",
   "database" => "angeltalk",
   "username" => "angeltalk",
   "password" => "webrtc1@"
]);
