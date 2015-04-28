<!--  This is the body view of the project summary page    -->
<div class="container">
    <?php

    foreach ($result as $summary) {

    $image = $summary->image;
    $image2 = $summary->image2;
    $image3 = $summary->image3;
    $description = $summary->project_summary;

    echo '<h1>' . $summary->project_title . '</h1>';
    echo '<p>' . $description . '</p>';
    echo '<br />';


    ?>
    <div class="row">
        <?php
        if ($image || $image2 || $image3) {
            echo '<h2>Images</h2>';
            if ($image) {
                echo '<div class="col-md-4">';
                echo '<a  href="' . base_url() . 'uploads/' . $image . '" class="thumbnail"><img class="img-responsive"  src="' . base_url() . 'uploads/' . $image . '" alt="image1"></a>';
                echo '</div>';
            }
            if ($image2) {
                echo '<div class="col-md-4">';
                echo '<a href="' . base_url() . 'uploads/' . $image2 . '" class="thumbnail"><img class="img-responsive"  src="' . base_url() . 'uploads/' . $image2 . '" alt="image2"></a>';
                echo '</div>';
            }
            if ($image3) {
                echo '<div class="col-md-4">';
                echo '<a href="' . base_url() . 'uploads/' . $image3 . '" class="thumbnail"><img class="img-responsive" src="' . base_url() . 'uploads/' . $image3 . '" alt="image3"></a>';
                echo '</div>';
            }
        }
    }
        ?>

    </div>
</div>