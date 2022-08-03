<?php 
    $user = !empty($data['user'])?$data['user']:array();
?>
<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
    <div class="card">


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/add_users" method="POST">

                        <div class="form-group">
                            <label for="basicInput">User Name</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Name" name="name" value="<?php echo !empty($user['name'])?$user['name']:""?>">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">User Email</label>
                            <input type="email" class="form-control" id="basicInput" placeholder="Enter Email" name="email" value="<?php echo !empty($user['email'])?$user['email']:""?>">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">User Mobile</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Mobile" name="mobile" value="<?php echo !empty($user['mobile'])?$user['mobile']:""?>">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">User Role</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="role">

                                    <option value="1" <?php echo !empty($user['user_role'])&& $user['user_role']==1?"selected":""?>>Admin</option>
                                    <option value="2" <?php echo !empty($user['user_role'])&& $user['user_role']==2?"selected":""?>>Manager</option>
                                    <option value="3" <?php echo !empty($user['user_role'])&& $user['user_role']==3?"selected":""?>>Supervisor</option>
                                    <option value="4" <?php echo !empty($user['user_role'])&& $user['user_role']==4?"selected":""?>>User</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Organisation</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="organisation">
                                    <?php
                                    foreach ($data['orgs'] as $org) {
                                    ?>
                                        <option value="<?php echo $org['id']; ?>"><?php echo $org['name']; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </fieldset>
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