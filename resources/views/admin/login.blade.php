<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Admin Login</title>

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('public/adminpanel/assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('public/adminpanel/assets/css/font-awesome.min.css')}}">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('public/adminpanel/assets/css/style.css')}}">

    </head>
    <body class="account-page">

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a>
				<div class="container">

					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.html"><img src="{{asset('public/adminpanel/assets/img/logo2.png')}}" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->

					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
                            @include('admin.includes._message')
							<!-- Account Form -->
							<form action="{{route('adminLogin')}}" method="POST">
                                @csrf
								<div class="form-group">
									<label>Email Address</label>
									<input class="form-control" type="text" name="email">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col">
											<label>Password</label>
										</div>
									</div>
									<input class="form-control" type="password" name="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
								<div class="account-footer">
									<p>Forgot your password ? <a href="{{route('forgetPassword')}}">Reset Password</a></p>
								</div>
							</form>
							<!-- /Account Form -->

						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="{{asset('public/adminpanel/assets/js/jquery-3.2.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('public/adminpanel/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('public/adminpanel/assets/js/bootstrap.min.js')}}"></script>

		<!-- Custom JS -->
		<script src="{{asset('public/adminpanel/assets/js/app.js')}}"></script>

    </body>
</html>
