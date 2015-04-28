<!-- This is the view for a lecturer profile -->
<div class="container">
    <div class="page-header">
        <h1>Lecturer Profile</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php

        if ($profile) {

            foreach ($profile as $lecturer) {

                //Ensures the first letter is Uppercase
                $firstname = $lecturer->first_name;
                $firstname = ucwords($firstname);
                $lastname = $lecturer->last_name;
                $lastname = ucwords($lastname);

                echo '<div class="col-md-3">';
                //Checks if the user has an profile image as .jpg or png, if there's no profile picture, displays the default one
                if (file_exists("uploads/" . $lecturer->username . ".jpg")) {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/' . $lecturer->username . '.jpg">';
                } elseif (file_exists("uploads/" . $lecturer->username . ".png")) {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/' . $lecturer->username . '.png">';
                } else {
                    echo '<img height="200" width="200" src="' . base_url() . 'uploads/no_profile_picture.jpg">';
                }
                echo '<p><strong>Name:</strong> ' . $firstname . ' ' . $lastname . '</p>';

                if($proposals){

                    echo '<h3>Current Available Projects</h3>';

                    foreach($proposals as $proposal){

                        echo '<ul class="list-group">';
                        echo '<a href="'. base_url() . "index.php/proposal/" . $proposal->proposal_id .'" class="list-group-item">' . $proposal->proposal_title . '</a>';
                        echo '</ul>';

                    }

                }

                echo '</div>';

                echo '<div class="col-md-9">';
                echo '<h2>Lecturer Information</h2>';
                echo '<p>' . $lecturer->profile_description . '</p>';
                echo '<h2>Specialist Areas</h2>';
                echo '<p>' . $lecturer->specialist_areas . '</p>';
                echo '<br /><p><strong>Lecturer email:</strong> ' . $lecturer->email . '</p>';
                echo '<p><strong>Project Support: </strong>' . $lecturer->support_projects . '</p>';



                echo '</div>';
                echo '<br />';

            }
        } else {
            echo '<p>The profile you are trying to access can not be found</p>';
        }




        ?>
    </div>
</div>