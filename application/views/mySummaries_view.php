<!--  This is the body view of lecturers summaries  -->
<div class="container">
    <div class="page-header">
        <h1>My Summaries</h1>
    </div>
</div>

    <?php

    if ($summaries) {
        foreach ($summaries as $summary) {
            $image = $summary->image;
            $image2 = $summary->image2;
            $image3 = $summary->image3;
            $description = $summary->project_summary;

            echo '<div class="container">';
            echo '<h1>' . $summary->project_title . '</h1>';
            echo '<p>' . $description . '</p>';
            echo '<br />';


    ?>
</div>
    <div class="container">
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
            echo '</div>';
        }
            echo "<a class='btn btn-primary' href='" . base_url() . "index.php/MySummaries/editSummary/" . $summary->summary_id . "'>Edit Summary</a>";
            echo '<div id="pagination">' . $links . '</div><br/>';
            echo '</div>';

        }
    }
        ?>
<br>
