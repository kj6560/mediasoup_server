<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
  <div class="card">


    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="/add_conference" method="POST">

            <div class="form-group">
              <label for="basicInput">Conference Title</label>
              <input type="text" class="form-control" id="basicInput" placeholder="Enter email" name="title">
            </div>

            <div class="form-group">
              <label for="basicInput">Conference Type</label>
              <fieldset class="form-group">
                <select class="form-select" id="basicSelect" name="conference_type">
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </fieldset>
            </div>
            <div class="form-group">
              <select class="choices form-select multiple-remove" multiple="multiple" name="conference_for">
                <optgroup label="Figures">
                  <option value="romboid">Romboid</option>
                  <option value="trapeze" selected>Trapeze</option>
                  <option value="triangle">Triangle</option>
                  <option value="polygon">Polygon</option>
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