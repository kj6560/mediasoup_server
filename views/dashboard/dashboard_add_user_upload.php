<?php
$user = !empty($data['user']) ? $data['user'] : array();
?>
<link rel="stylesheet" href="assets/css/pages/form-element-select.css">
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">With Validation</h5>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p class="card-text">Using the basic table up, upload here to see how
                    <code>.with-validation-filepond</code>-based basic file uploader look. You can use
                    <a href="https://pqina.nl/filepond/docs/patterns/plugins/file-validate-size/#properties" target="_blank">see here</a>
                    or <code>required (to make your input required), data-max-file-size (to limit your input file size),
                        data-max-files (to limit your uploaded files), etc (start with data-)</code> attribute
                    too to implement validation.
                </p>
                <!-- File uploader with validation -->
                <input type="file" class="with-validation-filepond" required multiple data-max-file-size="1MB" data-max-files="3">
            </div>
        </div>
    </div>
</section>
<script src="assets/js/app.js"></script>
<script src="assets/js/extensions/filepond.js"></script>