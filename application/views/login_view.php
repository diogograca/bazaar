<!--  This is the body view of  the login page  -->
<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>
</div>

<div class="container">
    <form class="form-horizontal" role="form" method="POST"
          action="<?php echo base_url(); ?>index.php/login/user_login">
        <div class="form-group">
            <label class="control-label col-sm-2" for="username">Username:</label>

            <div class="col-sm-5">
                <input type="text" class="form-control" name="username" size="20" placeholder="Username">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password:</label>

            <div class="col-sm-5">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo validation_errors(); ?>
                <?php
                if (isset($error)) {
                    echo '<p>Password and Username does not match</p>';
                }
                ?>
                <button type="submit" class="btn btn-info">Login</button>
            </div>
        </div>
    </form>
</div>
