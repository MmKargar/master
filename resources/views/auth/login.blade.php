<html lang="en" dir="rtl" direction="rtl" style="direction:rtl">

	<!-- begin::Head -->
	<head>

		<!--begin::Base Path (base relative path for assets of this page) -->
		<base href="../../../../">

		<!--end::Base Path -->
		<meta charset="utf-8" />
		<title>بومان | صفحه ورود</title>
		<meta name="description" content="Login page example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{asset('metro/css/login/login-2.rtl.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{asset('metro/css/global/vendors.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('metro/css/global/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{asset('metro/css/global/base/light.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('metro/css/global/menu/light.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('metro/css/global/brand/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('metro/css/global/aside/dark.rtl.css')}}" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{asset('metro/media/fav/fav.png')}}" />
        
        {{-- custom styles --}}
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">


		<meta name="csrf-token" content="{{csrf_token()}}">
		<script>
			var check_signup_route = "{{route('check_signup')}}";
			var register_route = "{{route('register')}}";
			var mobexist_route = "{{route('mobexist')}}";
			var sendcode_route = "{{route('sendcode')}}";
			var confirm_code_route = "{{route('confirm_code')}}";
			var sign_route = "{{route('sign')}}";
			var dashboard_route = "{{route('dashboard.index')}}";
			let mobile = '';
		</script>

	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset('metro/media/bg/bg-1.jpg')}});">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="{{asset('metro/media/logo/logo-mini-2-md.png')}}">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">ورود به بومان</h3>
								</div>
								<form class="kt-form" action="" id="signin"  v-on:keyup.enter="sign">
									<div class="form-group">
										<input v-validate="'required|max:190'" style="direction:rtl;color:white" class="form-control" type="text" placeholder="شماره همراه" name="mobile" autocomplete="off">
										<small >@{{ errors.first('mobile') }}</small>
									</div>
									<div class="form-group">
										<input v-validate="'required|max:190'" style="direction:rtl;color:white" class="form-control" type="password" placeholder="کلمه عبور" name="password">
										<small >@{{ errors.first('password') }}</small>
									</div>
									<div class="row kt-login__extra">
										<div class="col">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember"> مرا بخاطر بسپار
												<span></span>
											</label>
										</div>
										<div class="col kt-align-right">
											<a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">کلمه عبور خود را فراموش کرده اید؟</a>
										</div>
									</div>
									<div class="kt-login__actions">
											{{-- id="kt_login_signin_submit" --}}
										<button  type="button" style="display:none"  id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary"></button>
										<button  type="button" v-if="!checking"  @click="sign" class="btn btn-pill kt-login__btn-primary  ">ورود</button>
										<button  type="button" v-if="checking" class="btn btn-pill kt-login__btn-primary  kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light">درحال بررسی ورودی ها </button>
										<button id="not_activated" style="display:none"></button>
										<button id="kt_login_signin_submited" style="display:none"></button>
										
									</div>
								</form>
							</div>
							<div class="kt-login__signup" id="login">
								<div class="kt-login__head">
									<h3 class="kt-login__title">ثبت نام</h3>
									<div class="kt-login__desc">فرم زیر را کامل کنید:</div>
								</div>
								<form class="kt-login__form kt-form form-row" action="" >
									<div class="form-group col-md-6">
										<input class="form-control" v-validate="'required|max:190'" type="text" placeholder="نام" name="first_name">
										<small >@{{ errors.first('first_name') }}</small>
                                    </div>
                                    <div class="form-group col-md-6">
										<input class="form-control" v-validate="'required|max:190'" type="text" placeholder="نام خانوادگی"  name="last_name">
										<small >@{{ errors.first('last_name') }}</small>
                                    </div>
                                    <div class="form-group col-md-6">
										<input class="form-control" v-validate="'required|digits:11|unique:mobile'"  type="text" placeholder="شماره همراه" name="mobilee">
										<small >@{{ errors.first('mobilee') }}</small>
									</div>
                                    <div class="form-group col-md-6">
										<input class="form-control" v-validate="'required|digits:10|unique:n_code'" type="text" placeholder="کد ملی" name="n_code">
										<small >@{{ errors.first('n_code') }}</small>
									</div>
									<div class="form-group col-md-6">
										<input class="form-control" v-validate="'required|min:8|max:190'" type="password" placeholder="کلمه عبور" name="passwordd"  ref="passwordd">
										<small >@{{ errors.first('passwordd') }}</small>
									</div>
									<div class="form-group">
										<input class="form-control" v-validate="'required|confirmed:passwordd|max:190'" type="password" placeholder="تکرار کلمه عبور" name="rpassword">
										<small >@{{ errors.first('rpassword') }}</small>
									</div>
									<div class="form-group col-md-6">
											<input class="form-control" v-validate="'required|email|unique:email'" type="text" placeholder="ایمیل" name="email" autocomplete="off">
											<small >@{{ errors.first('email') }}</small>
										</div>
									{{-- <div class="row kt-login__extra">
										<div class="col kt-align-left">
											<label class="kt-checkbox">
												<input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
												<span></span>
											</label>
											<span class="form-text text-muted"></span>
										</div>
									</div> --}}
									<div class="kt-login__actions">
											{{-- id="kt_login_signup_submit" at click --}}
										<button   v-if="!registring && !checking"  @click="validate" class="btn btn-pill kt-login__btn-primary">
												ثبت نام
										</button>&nbsp;&nbsp;

										<button v-if="checking" class="btn btn-pill kt-login__btn-primary">
												<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom:5px;"></span>
												درحال بررسی ورودی ها
										</button>&nbsp;&nbsp;

										<button v-if="registring && !checking"  class="btn btn-pill kt-login__btn-primary">
												<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom:5px;"></span>
												در حال ارسال اطلاعات به سرور
										</button>&nbsp;&nbsp;

										<button id="kt_login_signup_cancel" class="btn btn-pill kt-login__btn-secondary">لغو</button>
										<button id="kt_login_signup_submit"  style="display:none"></button>
									</div>

								</form>
							</div>
							<div class="kt-login__forgot">
								<div class="kt-login__head">
									<h3 class="kt-login__title">کلمه عبور خود را فراموش کرده اید؟</h3>
									<div class="kt-login__desc">شماره همراه خود را وارد کنید:</div>
								</div>
								<form class="kt-form" action="" id="forget">
									<div class="form-group" v-if="!show_verify_button">
											{{-- id="kt_email" --}}
										<input class="form-control"  name="mobile_forget" v-validate="'required|digits:11|mobexist'" type="text"  placeholder="شماره همراه"  autocomplete="off">
										<small style="color:white">@{{ errors.first('mobile_forget') }}</small>
									</div>
									<div class="form-group" v-if="show_verify_button">
											{{-- id="kt_email" --}}
										<input class="form-control"  name="mobile_verify"  type="text"  placeholder="کد ارسال شده به گوشی را وارد کنید"  autocomplete="off">
										<small style="color:white" v-if="not_confirmed">کد وارد شده صحیح نیست</small>
									</div>
									<div class="kt-login__actions">
											{{-- id="kt_login_forgot_submit" --}}
										<button v-if="!sending_code && !show_verify_button && !checking" @click="validate"  class="btn btn-pill kt-login__btn-primary">ارسال کد</button>&nbsp;&nbsp;
										<button v-if="show_verify_button  && !checking" @click="verify"  class="btn btn-pill kt-login__btn-primary">تایید کد</button>&nbsp;&nbsp;
										<button v-if="sending_code  && !show_verify_button  && !checking"    class="btn btn-pill kt-login__btn-primary">
											<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom:5px;"></span>
											درحال ارسال کد
										</button>&nbsp;&nbsp;

										<button v-if="!sending_code  && !show_verify_button  && checking"    class="btn btn-pill kt-login__btn-primary">
											<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom:5px;"></span>
											درحال بررسی کد
										</button>&nbsp;&nbsp;
										
										<button id="kt_login_forgot_submit" style="display:none"   class="btn btn-pill kt-login__btn-primary">


										<button id="kt_login_forgot_cancel" class="btn btn-pill kt-login__btn-secondary">لغو</button>
									</div>
								</form>
							</div>
							<div class="kt-login__account" style="direction:rtl">
								<span class="kt-login__account-msg">
									حساب کاربری ندارید؟  برای ثبت نام 
								</span>
								<span style="color:white;margin:0">
									<a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link"> اینجا </a>
									کلیک کنید
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{asset('metro/js/global/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('metro/js/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="{{asset('metro/js/login/login-general.js')}}" type="text/javascript"></script>

		<!--end::Page Scripts -->
		<script src="{{asset('js/login.js')}}"></script>

		
	</body>

	<!-- end::Body -->
</html>