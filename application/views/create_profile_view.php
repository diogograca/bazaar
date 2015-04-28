<!--  This is the body view of the create a profile page    -->
<div class="container">
    <div class="page-header">
        <h1>Create Profile</h1>
    </div>
</div>
<div class="container">
    <form method="POST" action="<?php echo base_url(); ?>index.php/createProfile/create_profile">
        <div class="row">
            <div class="col-md-6">
                <label for="description">Description: </label>
                <br>
                <textarea rows="20" cols="60" name="description"><?php echo set_value('description'); ?></textarea>
                <br>
            </div>
            <div class="col-md-6">

                <label for="areas">Specialist Areas: </label>
                <br>
                <textarea rows="10" cols="60" name="areas"><?php echo set_value('areas'); ?></textarea>
                <br>
            </div>
        </div>
        <label for="support">Can you support projects?</label>
        <input type="radio" name="support" value="Yes" checked>Yes
        <input type="radio" name="support" value="No">No
        <br>
        <?php echo validation_errors(); ?>
        <input class="btn btn-primary" type="submit" value="Create profile"/>
    </form>
    <br>
</div>
<br>