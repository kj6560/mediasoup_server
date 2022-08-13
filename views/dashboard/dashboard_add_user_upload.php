<?php
$user = !empty($data['user']) ? $data['user'] : array();
?>
<link rel="stylesheet" href="<?php echo BASE . 'assets/css/pages/filepond.css' ?>">
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">With Validation</h5>
        </div>
        <div class="card-content">
            <form action="/add_users_upload" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <p class="card-text">Using the basic table up, upload here to see how
                        <code>.with-validation-filepond</code>-based basic file uploader look. You can use
                        <a href="https://pqina.nl/filepond/docs/patterns/plugins/file-validate-size/#properties" target="_blank">see here</a>
                        or <code>required (to make your input required), data-max-file-size (to limit your input file size),
                            data-max-files (to limit your uploaded files), etc (start with data-)</code> attribute
                        too to implement validation.
                    </p>
                    <!-- File uploader with validation -->

                    <input type="file" name="file" id="file" class="basic-filepond">

                </div>
                <div class="form-group">
                    <input class="form-group" type="submit" id="submit" name="submit" value="Upload">

                </div>
            </form>
        </div>
    </div>
</section>
<script src="assets/js/app.js"></script>
<script src="<?php echo BASE . 'assets/js/extensions/filepond.js' ?>"></script>