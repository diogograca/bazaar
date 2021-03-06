<!--  This is the body view of  lecturers profiles interface  -->
<div class="container">
    <div id="search_bar">
        <form class="float-right" method="POST" action="<?php echo base_url(); ?>index.php/lecturers/searchResults">
            <input type="search" placeholder="Search Lecturers" name="search_terms">
            <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>
</div>
<br>
<div class="container">
    <div class="page-header">
        <h1>Lecturers</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php

        if ($results) {

            foreach ($results as $lecturer) {

                echo '<div class="col-md-6 lecturer">';

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
        echo '<div id="pagination" class="clear-both">' . $links . '</div><br/>';
        ?>
    </div>
</div>

