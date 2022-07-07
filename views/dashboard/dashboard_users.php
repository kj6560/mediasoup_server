<?php

use App\ViewHelpers;
?>
<style>
  .dataTable-dropdown {
    display: none;
  }
</style>
<section class="section">
  <div class="card">
    <div class="card-header">
      <a href="/add_users" class="btn btn-success" style="float: right;">Add</a>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Organisation</th>
            <th>Role</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($data['users'] as $user) {
          ?>
            <tr>
              <td><a href="<?php echo "/user_detail/" . $user['id']; ?>"><?php echo $user['name'] ?></a></td>
              <td><?php echo $user['name'] ?></td>
              <td><?php echo ViewHelpers::getOrganisation($user['organisation']); ?></td>
              <td>
                <?php if ($user['is_available']) { ?>
                  <a href="<?php echo "/user_status/" . $user['id']."/".$user['is_available']; ?>"><span class="badge bg-success">Active</span></a>
                <?php } else { ?>
                  <a href="<?php echo "/user_status/" . $user['id']."/".$user['is_available']; ?>"><span class="badge bg-danger">InActive</span></a>
                <?php } ?>
              </td>
              <td><?php echo $user['user_date'] ?></td>
              <td>
                <a href="<?php echo "/user_edit/" . $user['id']; ?>"><span class="badge bg-secondary">Edit</span></a>
                <a href="<?php echo "/user_delete/" . $user['id']; ?>"><span class="badge bg-danger">Delete</span></a>
                <a href="<?php echo "/user_main/" . $user['id']; ?>" target="_blank"><span class="badge bg-primary">Join</span></a>
              </td>
            </tr>
          <?php
          }
          ?>


        </tbody>
      </table>
    </div>
  </div>

</section>

<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/simple-datatables.js"></script>