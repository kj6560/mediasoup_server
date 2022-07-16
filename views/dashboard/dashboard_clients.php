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
      <a href="/add_client" class="btn btn-success" style="float: left;">Add Client</a>
      <a href="/add_clients" class="btn btn-success" style="float: right;">Add clients</a>
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
                <a href="<?php echo "/client_edit/" . $client['id']; ?>"><span class="badge bg-secondary">Edit</span></a>
                <a href="<?php echo "/client_delete/" . $client['id']; ?>"><span class="badge bg-danger">Delete</span></a>
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