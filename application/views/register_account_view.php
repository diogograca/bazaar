<!--  This is the body view of the registration page   -->
<div class="container">
    <div class="page-header">
        <h1>Register New User</h1>
    </div>
</div>

<div class="container">
    <form class="form-horizontal" role="form" method="post"
          action="<?php echo base_url(); ?>index.php/register/create_account">
        <div class="form-group">
            <label class="control-label col-sm-2" for="first_name">First Name:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="first_name" placeholder="First Name"
                       value="<?php echo set_value('first_name'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="last_name">Last Name:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                       value="<?php echo set_value('last_name'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="username">Username:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="username" placeholder="Username"
                       value="<?php echo set_value('username'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>

            <div class="col-sm-5">
                <input type="email" class="form-control" name="email" placeholder="Email"
                       value="<?php echo set_value('email'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>

            <div class="col-sm-5">
                <input type="password" class="form-control" name="password" placeholder="Enter password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="password_confirmation">Confirm Password:</label>

            <div class="col-sm-5">
                <input type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirm password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
                <?php echo validation_errors(); ?>
                <button type="submit" class="btn btn-default">Create Account</button>
            </div>
        </div>
    </form>
    <br>
</div>


