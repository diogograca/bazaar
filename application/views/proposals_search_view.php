<!--  This is the body view of  the search results of the lecturers proposals  -->
<div class="container">
    <div id="search_bar">
        <form class="float-right" method="POST" action="<?php echo base_url(); ?>index.php/proposals/searchResults">
            <input type="search" placeholder="Search Proposals" name="search_terms">
            <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>
    <?php

    $count = count($results);
    echo '<p>We have found <strong>' . $count . '</strong> results.</p>';
    if ($results) {

        foreach ($results as $result) {
            $description = $result->proposal_description;
            $description = strip_tags($description);
            $description = word_limiter($description, 150);
            $proposal_id = $result->proposal_id;

            echo '<section class="proposal">';
            echo '<h1>' . $result->proposal_title . '</h1><p>' . $description . '</p>';
            echo "<a class='btn btn-default' href='" . base_url() . "index.php/proposal/" . $proposal_id . "'>View Proposal</a>";
            echo '</section>';
        }
    } else {
        echo '<p>Sorry, your search doesn\'t match our proposals</p>';
    }
    ?>
</div>

