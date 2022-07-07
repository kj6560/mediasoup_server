<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
  <div class="card">


    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="/add_conference" method="POST">

            <div class="form-group">
              <label for="basicInput">Conference Title</label>
              <input type="text" class="form-control" id="basicInput" placeholder="Enter email">
            </div>

            <div class="form-group">
              <label for="basicInput">Conference Type</label>
              <fieldset class="form-group">
                <select class="form-select" id="basicSelect">
                  <option>IT</option>
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </fieldset>
            </div>
            <div class="form-group">
              <select class="choices form-select multiple-remove" multiple="multiple">
                <optgroup label="Figures">
                  <option value="romboid">Romboid</option>
                  <option value="trapeze" selected>Trapeze</option>
                  <option value="triangle">Triangle</option>
                  <option value="polygon">Polygon</option>
                </optgroup>
                <optgroup label="Colors">
                  <option value="red">Red</option>
                  <option value="green">Green</option>
                  <option value="blue" selected>Blue</option>
                  <option value="purple">Purple</option>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="helperText">Conference Time </label>
              <input class="form-group" type="datetime-local" id="birthdaytime" name="birthdaytime">
              <p><small class="text-muted">Find helper text here for given textbox.</small>
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