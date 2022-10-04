<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<div class="container">
  <h1>Login</h1>
  <form method="post">
    <!-- Email input -->
    <div class="form-outline mb-4 ">
      <label class="form-label" for="form2Example1">Username</label>
      <input type="text" id="form2Example1" class="form-control" name="txtUsername"/>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example2">Password</label>
      <input type="password" id="form2Example2" class="form-control" name="txtPassword" />
    </div>


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4" name="btnLogin">Sign in</button>
  </form>
</div>