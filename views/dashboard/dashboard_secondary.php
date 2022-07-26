<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
    <div class="card">


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/conference_secondary/<?php echo $data['conf_id'];?>/<?php echo $data['user_id'];?>" method="POST">

                        
                        <div class="form-group">
                            <label for="basicInput">User Passkey</label>
                            <input type="password" class="form-control" id="basicInput" placeholder="Enter Passkey" name="passkey">
                        </div>
                        
                        
                        <div class="form-group">
                            <input class="form-group" type="submit" id="submit" name="submit" value="Create">

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</section>
<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/form-element-select.js"></script>