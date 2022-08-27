<?php

use App\AppHelpers;
use App\ViewHelpers;

$current_role = $data['current_user']['user_role'];
?>
<style>
  .dataTable-dropdown {
    display: none;
  }
</style>
<section class="section">
  <div class="card">
    <div class="card-header">
      <a href="/add_users_upload" class="btn btn-success" style="float: left;">Upload Users</a> <a href="/add_users" class="btn btn-success" style="float: right;">Add Users</a>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Organisation</th>
            <th>Organisation Type</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data['users'])
            foreach ($data['users'] as $user) {
          ?>
            <tr>
              <td><a href="<?php echo "/user_detail/" . $user['id']; ?>"><?php echo $user['user_name'] ?></a></td>
              <td><?php echo $user['org_name'] ?></td>
              <td><?php echo $user['org_parent'] != 0 ? "Client" : "Parent" ?></td>
              <td><?php echo ViewHelpers::getUserRole($user['role']); ?></td>
              <td>
                <?php if ($user['user_status']) { ?>
                  <a href="<?php echo "/user_status/" . $user['id'] . "/" . $user['user_status']; ?>"><span class="badge bg-success">Active</span></a>
                <?php } else { ?>
                  <a href="<?php echo "/user_status/" . $user['id'] . "/" . $user['user_status']; ?>"><span class="badge bg-danger">InActive</span></a>
                <?php } ?>
              </td>

              <td>
                <?php if (AppHelpers::canEdit($current_role)) { ?>
                  <a href="<?php echo "/user_edit/" . $user['id']; ?>"><span class="badge bg-secondary">Edit</span></a>
                <?php }
                if (AppHelpers::canDelete($current_role)) { ?>
                  <a href="<?php echo "/user_delete/" . $user['id']; ?>"><span class="badge bg-danger">Delete</span></a>
              <?php }
              } ?>
              </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>

</section>

<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/simple-datatables.js"></script>