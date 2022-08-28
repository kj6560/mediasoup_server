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
      <?php
      if (AppHelpers::canCreate($current_role)) {
      ?>
        <a href="/add_client" class="btn btn-success" style="float: right;">Add Client</a>

      <?php } ?>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data['clients'])
            foreach ($data['clients'] as $client) {
          ?>
            <tr>
              <td><a href="<?php echo "/client_detail/" . $client['id']; ?>"><?php echo $client['name'] ?></a></td>
              <td><?php echo $client['address']; ?></td>
              <td><?php echo $client['mobile']; ?></td>
              <td>
                <?php if ($client['is_available']) { ?>
                  <a href="<?php echo "/client_status/" . $client['id'] . "/" . $client['is_available']; ?>"><span class="badge bg-success">Active</span></a>
                <?php } else { ?>
                  <a href="<?php echo "/client_status/" . $client['id'] . "/" . $client['is_available']; ?>"><span class="badge bg-danger">InActive</span></a>
                <?php } ?>
              </td>

              <td>
                <?php if (AppHelpers::canEdit($current_role)) { ?>
                  <a href="<?php echo "/client_edit/" . $client['id']; ?>"><span class="badge bg-secondary">Edit</span></a>
                <?php }
                if (AppHelpers::canDelete($current_role)) { ?>
                  <a href="<?php echo "/client_delete/" . $client['id']; ?>"><span class="badge bg-danger">Delete</span></a>
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