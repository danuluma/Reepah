{include('header.tpl')}
	<title>Login - {$system.name}</title>
	<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form>
                <div class="form-group">
                  <label>Enter your email address *</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Submit</button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="register.html"> Sign Up</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
{include('footer.tpl')}