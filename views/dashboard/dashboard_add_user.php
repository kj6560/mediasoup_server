<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
    <div class="card">


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/add_users" method="POST">

                        <div class="form-group">
                            <label for="basicInput">User Name</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">User Email</label>
                            <input type="email" class="form-control" id="basicInput" placeholder="Enter Address" name="email">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">User Mobile</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Mobile" name="mobile">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Organisation</label>
                            <fieldset class="form-group">
                                <select class="form-select" id="basicSelect" name="organisation">
                                    <option value="1">One To One</option>
                                </select>
                            </fieldset>
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