<!--  This is the body view of the proposals received   -->
<div class="container">
    <?php

    if ($proposals) {
        foreach ($proposals as $proposal) {

            echo '<section class="proposal">';
            echo '<h1>' . $proposal->student_proposal_title . '</h1>';
            echo '<p>' . $proposal->student_proposal_description . '</p>';
            echo '<p>By: ' . $proposal->first_name . ' ' . $proposal->last_name . '</p>';
            echo '<p>Email: ' . $proposal->email . '</p>';
            echo '</section>';

        }
    } else {
        echo '<p>You haven\'t received any student proposal yet.</p>';
    }
    ?>
    <?php
    echo '<div id="pagination">' . $links . '</div><br/>';
    ?>
</div>