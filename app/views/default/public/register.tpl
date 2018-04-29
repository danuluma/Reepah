{include('header.tpl')}
	<title>Register - {$system.name}</title>
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth-pages">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Create New Account</h3>
              <form>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Type</label>
                  <select class="form-control p_input">
                    <option>Admin</option>
                    <option>Viewer</option>
                  </select>
                </div>
                <p class="terms">By creating an account you are accepting our<a href="{$system.home}/tos"> Terms & Conditions</a></p>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">submit</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook col mr-2">
                      <i class="mdi mdi-facebook"></i> Facebook
                  </button>
                  <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus
                  </button>
                </div>
                <p class="sign-up text-center">Already have an Account?<a href="{$system.home}/login"> Sign In</a></p>
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
{include('footer.tpl')}