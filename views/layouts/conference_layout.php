<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title><?php echo SITE_NAME;?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js" integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo  BASE.'js/EventEmitter.min.js'; ?>"></script>
    <script src="<?php echo  BASE.'js/mediasoupclient.min.js';?>"></script>
    <script src="<?php echo  BASE.'js/RoomClient.js';?> "></script>
    <script src="<?php echo  BASE.'js/index.js'; ?>"></script>
    
</head>

<body>
    <?php require $data['view'];  ?>
</body>


</html>