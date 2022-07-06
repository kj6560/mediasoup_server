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
        <div class="dropdown">
          <a href="#" class="btn bg-gradient-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
            <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/icons/flags/US.png" /> Flags
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
            <li>
              <a class="dropdown-item" href="#">
                <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/icons/flags/DE.png" /> Deutsch
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/icons/flags/GB.png" /> English(UK)
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/icons/flags/BR.png" /> Brasil
              </a>
            </li>
          </ul>
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