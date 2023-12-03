<?php
  require './inc/header.php';
?>
  <section class="signin-masthead">
    <div>
      <h3>Sign In</h3>
    </div>
  </section>
  <main>
    <section class="row signin-row">
      <div class="col align-self-center">
        <h3>It Looks Like You Are Not Signed In!</h3>
        <p>Sign in below</p>
        <form method="post" action="./inc/validate.php">
          <p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
          <p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input class="btn btn-primary" type="submit" value="Login" />
        </form>
      </div>
    </section>
  </main>
<?php
  require './inc/footer.php';
?>
