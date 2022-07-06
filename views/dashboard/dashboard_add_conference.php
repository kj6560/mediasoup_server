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
        <select class="mdb-select md-form" searchable="Search here..">
          <option value="" disabled selected>Choose your country</option>
          <option value="1">USA</option>
          <option value="2">Germany</option>
          <option value="3">France</option>
          <option value="3">Poland</option>
          <option value="3">Japan</option>
        </select>
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