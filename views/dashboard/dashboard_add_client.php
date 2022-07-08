<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
    <div class="card">


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/add_client" method="POST">

                        <div class="form-group">
                            <label for="basicInput">Client Name</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Client Address</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Client Mobile</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Enter Mobile" name="mobile">
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