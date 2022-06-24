<?php 

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
   "driver" => "mysql",
   "host" =>"54.70.129.232",
   "database" => "angeltalk",
   "username" => "angeltalk",
   "password" => "webrtc1@"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
