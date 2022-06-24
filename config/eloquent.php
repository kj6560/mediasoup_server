<?php 


use Illuminate\Database\Capsule\Manager as DB;
$DB = new DB;
$DB->addConnection([
   "driver" => "mysql",
   "host" =>"54.70.129.232",
   "database" => "angeltalk",
   "username" => "angeltalk",
   "password" => "webrtc1@"
]);
$DB->setAsGlobal();  //this is important
$DB->bootEloquent();
