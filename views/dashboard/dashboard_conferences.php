<section class="section">
  <div class="card">
    <div class="card-header">
      All Conferences
      <a href="/add_conferences" class="btn btn-success" style="float: right;">Add</a>
      <?php print_r($data['conferences']); ?>
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
          <tr>
            <td>Graiden</td>
            <td>vehicula.aliquet@semconsequat.co.uk</td>
            <td>076 4820 8838</td>
            <td>
              <span class="badge bg-success">Active</span>
            </td>
            <td>Offenburg</td>

          </tr>

        </tbody>
      </table>
    </div>
  </div>

</section>

<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/simple-datatables.js"></script>