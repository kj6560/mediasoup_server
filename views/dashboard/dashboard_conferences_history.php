<?php

use App\AppHelpers;
use App\ViewHelpers;

$current_user_id = $data['current_user']['id'];
$current_role = $data['current_user']['user_role'];
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
                        <th>Name</th>
                        <th>Host</th>
                        <th>Participants</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data['conferences'])
                        foreach ($data['conferences'] as $conference) {
                            $participants = explode(',', $conference['conference_for']);
                            if (in_array($current_user_id, $participants) || AppHelpers::isAdmin($current_role) || AppHelpers::isMaster($current_role)) {
                    ?>
                            <tr>
                                <td><?php echo $conference['title'] ?></td>
                                <td><?php echo $conference['name'] ?></td>
                                <td><?php echo ViewHelpers::getParticipants($conference['conference_for']); ?></td>
                                <td>
                                    <?php if ($conference['is_available'] && !$conference['is_deleted']) {
                                        if (AppHelpers::isValidConference($conference['conference_date'], $conference['conference_duration'])) {
                                    ?>
                                            <span class="badge bg-success"><?php echo $conference['is_available'] ? "Active" : "InActive"; ?></span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge bg-success">Expired</span>
                                        <?php
                                        }
                                    } else {

                                        if ($conference['is_deleted']) {
                                        ?>
                                            <span class="badge bg-danger"><?php echo $conference['session_ended'] ? "Session ended and Deleted" : "Deleted"; ?></span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge bg-danger"><?php echo $conference['session_ended'] ? "Session Ended" : "InActive"; ?></span>
                                        <?php
                                        }

                                        ?>

                                    <?php } ?>
                                </td>
                                <td><?php echo $conference['conference_date'] ?></td>

                            </tr>
                    <?php
                            }
                        }
                    ?>


                </tbody>
            </table>
        </div>
    </div>

</section>

<script src="assets/js/app.js"></script>

<script src="assets/js/extensions/simple-datatables.js"></script>