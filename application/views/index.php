<!-- This is the view for the homepage-->
<div class="container">
    <div class="page-header">
        <h1>Project Bazaar
        </h1>
    </div>
</div>


<div class="container">
    <div class="row">
        <?php

        if ($proposals) {

            foreach ($proposals as $proposal) {
                $description = $proposal->proposal_description;
                $description = strip_tags($description);
                $description = word_limiter($description, 150);
                $proposal_id = $proposal->proposal_id;

                echo '<div class="col-md-3 proposal">';
                echo '<h1>' . $proposal->proposal_title . '</h1><p>' . $description . '</p>';
                echo "<a href='" . base_url() . "index.php/proposal/" . $proposal_id . "' class='btn btn-default'>View Proposal</a>";
                echo '</div>';
            }
        } else {
            echo '<p>Projects coming soon, please check back in a few days</p>';
        }

        if ($profile) {

            foreach ($profile as $lecturer) {

                echo '<div class="col-md-3 lecturer">';

                echo '<h1>' . $lecturer->first_name . ' ' . $lecturer->last_name . '</h1>';
                //Checks if the user has an profile image as .jpg or png, if there's no profile picture, displays the default one
                if (file_exists("uploads/" . $lecturer->username . ".jpg")) {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/' . $lecturer->username . '.jpg">';
                } elseif (file_exists("uploads/" . $lecturer->username . ".png")) {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/' . $lecturer->username . '.png">';
                } else {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/no_profile_picture.jpg">';
                }

                $information = $lecturer->profile_description;
                $information = word_limiter($information, 100);

                echo '<h2>Lecturer Information</h2>';
                echo '<p>' . $information . '</p>';
                echo "<a href='" . base_url() . "index.php/lecturerProfile/" . $lecturer->profile_id . "' class='btn btn-default'>View Profile</a>";
                echo '</div>';
            }
        }
        ?>

    </div>
    <br>
</div>
<br>

