<?php

use App\AppHelpers;
use App\ViewHelpers;
?>
<style>
    .dataTable-dropdown {
        display: none;
    }
</style>
<section class="section">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Activity Type</th>
                        <th>Activity By</th>
                        <th>Activity Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data['logs'])
                        foreach ($data['logs'] as $log) {
                    ?>
                        <tr>
                            <td><?php echo $log['id'] ?></td>
                            <td><?php echo ACTIVITIES[$log['activity_type']] ?></td>
                            <td><?php echo $log['activity_by_name'] ?></td>
                            <td><?php echo $log['created_at'] ?></td>
                            <td><?php echo $log['remarks'] ?></td>
                        </tr>
                    <?php
                        }
                    ?>


                </tbody>
            </table>
        </div>
    </div>

</section>

<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/simple-datatables.js"></script>