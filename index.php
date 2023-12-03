<!-- Here we will add our header file. -->
<?php require ('./inc/header.php'); ?>
  <main>
    <section class="masthead">
      <div>
        <h1>Newsletter Toronto</h1>
      </div>
    </section>
    <section class="form-row row">
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>If you don't have an account, then sign up below!</h3>
        <form method="post" action="save-admin.php">
          
        	<p><input class="form-control" name="first_name" type="text" placeholder="First Name" required/></p>
        	<p><input class="form-control" name="last_name" type="text" placeholder="Last Name" required /></p>
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
        	<p><input class="form-control" name="confirm" type="password" placeholder="Confirm Password" required /></p>
          <input class="btn btn-light" type="submit" name="submit" value="Register" />
        </form>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>If you already have an account, then sign in below!</h3>
        <form method="post" action="./inc/validate.php">
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input class="btn btn-light" type="submit" value="Login" />
        </form>
      </div>
    </section>
  </main>
<!-- Let's add our footer file. -->
<?php require ('./inc/footer.php'); ?>
