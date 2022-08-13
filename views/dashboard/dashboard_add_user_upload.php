<?php
$user = !empty($data['user']) ? $data['user'] : array();
?>
<link rel="stylesheet" href="<?php echo BASE . 'assets/css/pages/filepond.css' ?>">
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><a href="/downloadUserUploadTemplate">Download Template</a></h5>
        </div>
        <div class="card-content">
            <form action="/add_users_upload_file" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                   
                    <!-- File uploader with validation -->

                    <input type="file" name="csv" id="csv" class="basic-filepond">

                </div>
                <div class="form-group">
                    <input class="form-group" type="submit" id="submit" name="submit" value="Upload">

                </div>
            </form>
        </div>
    </div>
</section>

<script src="<?php echo BASE . 'assets/js/extensions/filepond.js' ?>"></script>