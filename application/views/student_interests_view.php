<!--  This is the body view of the student interests in a project page    -->
<div class="container">
    <div class="page-header">
        <h1>Student Interests</h1>
    </div>
</div>
<div class="container">
    <?php

    if ($interests) {
        foreach ($interests as $interest) {

            echo '<p><strong>Student Name: </strong>' . $interest->first_name . ' ' . $interest->last_name . '</p>';
            echo '<p><strong>Student Email: </strong>' . $interest->email . '</p>';
        }
    } else {
        echo '<p>You have no student interests in this project at the moment</p>';
    }
    ?>
</div>