    <?php if (isset($user)) : ?>
        <?php if ($user->hasErrors()) : ?>
            <?php foreach ($user->getErrors("general") as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="flexContainer">Account created succesfully!</p>
            <?php unset($user); ?>
        <?php endif ?>
    <?php endif ?>

<main>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" style="border:1px solid black">
    <div class="formulaire ">
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for=password><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name=password required>

        <button type="submit">Login</button>

        <input type="checkbox" checked="checked" name="remember-me" value=true> 
        <label for="remember-me">Remember me!</label>
       
    </div>

    <div class="flexContainer" id="fallback">
        <button type="button" class="cancel-btn">Cancel</button>
        <span class="password">Forgot <a href="#">password?</a></span>
    </div>
</form>
</main>