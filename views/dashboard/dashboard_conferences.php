<section class="section">
  <div class="card">
    <div class="card-header">
      All Conferences
      <a href="/add_conferences" class="btn btn-success" style="float: right;">Add</a>
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
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($data['conferences'] as $conference) {
          ?>
            <tr>
              <td><?php echo $conference['title'] ?></td>
              <td><?php echo $conference['name'] ?></td>
              <td><? echo $conference['conference_for'] ?></td>
              <td>
                <? if ($conference['is_available']){ ?>
                <span class="badge bg-success">Active</span>
                <? }else{ ?>
                <span class="badge bg-failure">InActive</span>
                <? } ?>
              </td>
              <td>Offenburg</td>

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