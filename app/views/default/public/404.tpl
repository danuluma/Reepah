<!DOCTYPE html>
<html>
<head>
	<?php os_styles(); ?>
	<title>Error 404 - {$system.name}</title>
</head>
<body>
	<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center text-center error-page">
          <div class="col-lg-6 mx-auto">
            <h1 class="display-1 mb-0">404</h1>
            <h2 class="mb-4">Page Not Found!</h2>
            <p>You seem to be trying to find your way home</p>
            <a class="btn btn-primary mt-5 btn-rounded btn-lg" href="{$system.home}">Back to home</a>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</body>
</html>