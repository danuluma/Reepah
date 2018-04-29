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
                  <label>User *</label>
                  <input type="text" class="form-control p_input" placeholder="Email Address or Phone">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="text" class="form-control p_input" placeholder="Password">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input">
                        Remember me
                      </label>
                  </div>
                  <a href="{$system.home}/forgot" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook mr-2 col-md-6">
                      <i class="mdi mdi-facebook"></i> Facebook
                  </button>
                  <button class="btn btn-google col-md-6">
                      <i class="mdi mdi-google-plus"></i> Google plus
                  </button>
                </div>
                <p class="sign-up">Don't have an Account?<a href="{$system.home}/register"> Sign Up</a></p>
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