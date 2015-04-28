<!-- This is a view for the past projects page  -->
<div class="container">
    <div class="page-header">
        <h1>Past Projects Summaries</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php
        if($results) {
            foreach ($results as $summary) {

                $description = $summary->project_summary;
                $description = strip_tags($description);
                $description = word_limiter($description, 150);

                echo '<div class="col-md-3 lecturer">';
                echo '<h1>' . $summary->project_title . '</h1>';
                echo '<p>' . $description . '</p>';
                echo "<a href='" . base_url() . "index.php/ProjectSummary/" . $summary->summary_id . "' class='btn btn-default' >View Project</a>";
                echo '<br />';
                echo '</div>';

            }
        }else{
            echo "<p>There are no project summaries available at the moment, please check back in a few days</p>";
        }
        ?>
    </div>

    <?php
    echo '<div id="pagination">' . $links . '</div><br/>';
    ?>
</div>