<div class="p-4 bg-light">
  <form action="/add_conference" method="POST">
    <div class="row">
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" disabled>
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