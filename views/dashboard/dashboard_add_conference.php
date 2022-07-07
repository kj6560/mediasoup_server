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
              <fieldset class="form-group">
                <select class="form-select" id="basicSelect">
                  <option>IT</option>
                  <option>Blade Runner</option>
                  <option>Thor Ragnarok</option>
                </select>
              </fieldset>
            </div>

            <div class="form-group">
              <label for="helperText">With Helper Text</label>
              <input type="text" id="helperText" class="form-control" placeholder="Name">
              <p><small class="text-muted">Find helper text here for given textbox.</small>
              </p>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
</section>