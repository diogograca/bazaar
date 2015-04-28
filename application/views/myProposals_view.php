<!--  This is the body view of lecturers proposals  -->
<div class="container">
    <div class="page-header">
        <h1>My Proposals</h1>
    </div>
</div>
<div class="container">
    <?php

    if ($proposals) {
        foreach ($proposals as $proposal) {
            $description = $proposal->proposal_description;
            //$description = word_limiter($description, 150);
            $proposal_id = $proposal->proposal_id;

            echo '<h1>' . $proposal->proposal_title . '</h1><p>' . $description . '</p>';
            echo "<a class='btn btn-primary' href='" . base_url() . "index.php/myProposals/editProposal/" . $proposal_id . "'>Edit Proposal</a>";
            echo '<br>';
            echo '<br>';
            echo "<a class='btn btn-primary' href='" . base_url() . "index.php/StudentInterests/" . $proposal_id . "'>View Student Interests</a>";

            echo '<div id="pagination">' . $links . '</div><br/>';

        }
    } else {
        echo '<p>You have no proposals.</p>';
    }
    ?>
    <br>
</div>
<br>
<br>