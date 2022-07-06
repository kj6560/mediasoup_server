<div class="p-4 bg-light">
  <form action="/add_conference" method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Title</label>
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="container mt-5">
          <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true">
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
            <option value="4">Four</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline is-valid my-3">
          <label class="form-label">Success</label>
          <input type="email" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group input-group-outline is-invalid my-3">
          <label class="form-label">Error</label>
          <input type="email" class="form-control">
        </div>
      </div>
    </div>
  </form>
</div>