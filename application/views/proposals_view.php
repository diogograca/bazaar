<!--  This is the body view of lectures proposals interface   -->
<div class="container">
    <div id="search_bar">
        <form class="float-right" method="POST" action="<?php echo base_url(); ?>index.php/proposals/searchResults">
            <input type="search" placeholder="Search Proposals" name="search_terms">
            <button class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>
</div>
<br>
<div class="container">
    <div class="page-header">
        <h1>Project Proposals</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php
        if($proposals) {
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
        }else {
            echo "<p>There are no proposals available at the moment, please check back in a few days</p>";
        }
        ?>
    </div>

    <?php
    echo '<div id="pagination">' . $links . '</div><br/>';
    ?>
</div>