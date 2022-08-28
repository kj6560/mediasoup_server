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
        <a href="/add_conferences" class="btn btn-success" style="float: right;">Add</a>
      <?php } ?>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>Name</th>
            <th>Host</th>
            <th>Participants</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($data['conferences'])
            foreach ($data['conferences'] as $conference) {
          ?>
            <tr>
              <td><a href="<?php echo "/conference_detail/" . $conference['id']; ?>"><?php echo $conference['title'] ?></a></td>
              <td><?php echo $conference['name'] ?></td>
              <td><?php echo ViewHelpers::getParticipants($conference['conference_for']); ?></td>
              <td>
                <?php if ($conference['is_available']) {
                  if (AppHelpers::isValidConference($conference['conference_date'], $conference['conference_duration'])) {
                ?>
                    <a href="<?php echo "/conference_status/" . $conference['id'] . "/" . $conference['is_available']; ?>"><span class="badge bg-success">Active</span></a>
                  <?php
                  } else {
                  ?>
                    <span class="badge bg-success">Expired</span>
                  <?php
                  }
                } else { ?>
                  <a href="<?php echo "/conference_status/" . $conference['id'] . "/" . $conference['is_available']; ?>"><span class="badge bg-danger">InActive</span></a>
                <?php } ?>
              </td>
              <td><?php echo $conference['conference_date'] ?></td>
              <td>
                <?php if (AppHelpers::canEdit($current_role)) { ?>
                  <a href="<?php echo "/conference_delete/" . $conference['id']; ?>"><span class="badge bg-danger">Delete</span></a>
                <?php }
                if (AppHelpers::canDelete($current_role)) { ?>
                  <a href="<?php echo "/conference_main/" . $conference['id']; ?>" target="_blank"><span class="badge bg-primary">Join</span></a>
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