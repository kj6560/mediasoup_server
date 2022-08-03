<?php
$conf = !empty($data['conference']) ? $data['conference'] : array();
?>
<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
  <div class="card">


    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo !empty($conf) ? "/conference_edit/" . $conf['id'] : "/add_conferences" ?>" method="POST">

            <div class="form-group">
              <label for="basicInput">Conference Title</label>
              <input type="text" class="form-control" id="basicInput" placeholder="Enter email" name="title">
            </div>

            <div class="form-group">
              <label for="basicInput">Conference Type</label>
              <fieldset class="form-group">
                <select class="form-select" id="basicSelect" name="conference_type">
                  <option value="1">One To One</option>
                  <option value="2">Many To Many</option>
                </select>
              </fieldset>
            </div>
            <div class="form-group">
              <label for="basicInput">Select participants for conference</label>
              <select class="choices form-select multiple-remove" multiple="multiple" name="conference_for[]">
                <optgroup label="Organisation Users">
                  <?php
                  foreach ($data['users'] as $user) {
                  ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                  <?php
                  }
                  ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="helperText">Conference Time </label>
              <input class="form-group" type="datetime-local" id="conference_date" name="conference_date">
              <p><small class="text-muted">Select conference time and date</small>
              </p>
            </div>
            <div class="form-group">
              <label for="basicInput">Conference Duration</label>
              <input type="number" class="form-control" id="basicInput" placeholder="Enter duration in minutes" name="duration">
            </div>
            <div class="form-group">
              <input class="form-group" type="submit" id="submit" name="submit" value="<?php echo !empty($conf) ? "Update" : "Create" ?>">

            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
</section>
<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/form-element-select.js"></script>