<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style="border:1px solid black">
   <div class="container">
        <h1>Sign up</h1>
        <p> Please enter your informations.</p>
        <hr>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Select username" name="username" value="<?php echo isset($user) ? $user->getUsername() : '' ?>" required>
		<span><?php echo isset($user) && $user->getError('username') ? $user->getError('username') : ''?></span>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" value="<?php echo isset($user) ? $user->getEmail() : '' ?>" required>
		<span><?php echo isset($user) && $user->getError('email') ? $user->getError('email') : ''?></span>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
		<span><?php echo isset($user) && $user->getError('password') ? $user->getError('password') : ''?></span>

        <label for="passwordConf"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="passwordConf" required>
		<span><?php echo isset($user) && $user->getError('passwordConf') ? $user->getError('passwordConf') : ''?></span>

        <p>By creating an account you agree with our Terms & Privacy</p>

        <div class="clearfix">
            <button type="button" class="cancel-btn">Cancel</button>
            <button type="submit" class="signupb-btn">Sign Up</button>
        </div><!-- .clearfix-->

    </div><!-- .container -->
</form>
