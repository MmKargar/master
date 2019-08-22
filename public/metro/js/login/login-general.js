"use strict";
var KTLoginGeneral = function() {
    var t = $("#kt_login"),
        i = function(t, i, e) {
            var n = $('<div class="kt-alert kt-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            t.find(".alert").remove(), n.prependTo(t), KTUtil.animateClass(n[0], "fadeIn animated"), n.find("span").html(e)
        },
        e = function() {
            t.removeClass("kt-login--forgot"), t.removeClass("kt-login--signup"), t.addClass("kt-login--signin"), KTUtil.animateClass(t.find(".kt-login__signin")[0], "flipInX animated")
        },
        n = function() {
            $("#kt_login_forgot").click(function(i) {
                i.preventDefault(), t.removeClass("kt-login--signin"), t.removeClass("kt-login--signup"), t.addClass("kt-login--forgot"), KTUtil.animateClass(t.find(".kt-login__forgot")[0], "flipInX animated")
            }), $("#kt_login_forgot_cancel").click(function(t) {
                t.preventDefault(), e()
            }), $("#kt_login_signup").click(function(i) {
                i.preventDefault(), t.removeClass("kt-login--forgot"), t.removeClass("kt-login--signin"), t.addClass("kt-login--signup"), KTUtil.animateClass(t.find(".kt-login__signup")[0], "flipInX animated")
            }), $("#kt_login_signup_cancel").click(function(t) {
                t.preventDefault(), e()
            })
        };
    return {
        init: function() {
            n(), $("#kt_login_signin_submited").click(function(t) {
                t.preventDefault();
                var e = $(this),
                    n = $(this).closest("form");
                    e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "success", "ورود موفقیت آمیز! در حال انتقال به صفحه داشبورد.");
            }),                   
            n(), $("#not_activated").click(function(t) {
                t.preventDefault();
                var e = $(this),
                    n = $(this).closest("form");
                    e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "warning", "حساب کاربری شما هنوز فعال نشده است.");
            }),
            $("#kt_login_signin_submit").click(function(t) {
                t.preventDefault();
                var e = $(this),
                    n = $(this).closest("form");
                    e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "danger", "شماره همراه یا کلمه عبور اشتباه است.");
            }), $("#kt_login_signup_submit").click(function(n) {
                n.preventDefault();
                var s = $(this),
                    r = $(this).closest("form");
                r.validate({
                    rules: {
                        first_name: {
                            required: !0
                        },
                        last_name: {
                            required: !0
                        },
                        mobile:{
                            required: !0
                        },
                        n_code:{
                            required: !0
                        },
                        email: {
                            required: !0,
                        },
                        password: {
                            required: !0
                        },
                        rpassword: {
                            required: !0
                        }
                    }
                }), r.valid() && (s.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), r.ajaxSubmit({
                    url: "",
                    success: function(n, a, l, o) {
                        setTimeout(function() {
                            s.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), e();
                            var n = t.find(".kt-login__signin form");
                            n.clearForm(), n.validate().resetForm(), i(n, "success", "ثبت نام شما با موفقیت انجام شد ، بعد از تایید مدیریت می توانید وارد حساب کاربری خود شوید.")
                        }, 2e3);
                        console.log(r);
                    }
                }))
            }), $("#kt_login_forgot_submit").click(function(n) {
                n.preventDefault();
                var s = $(this),
                    r = $(this).closest("form");
                r.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        }
                    }
                }), r.valid() && (s.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), r.ajaxSubmit({
                    url: "",
                    success: function(n, a, l, o) {
                        setTimeout(function() {
                            s.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), e();
                            var n = t.find(".kt-login__signin form");
                            n.clearForm(), n.validate().resetForm(), i(n, "success", "کلمه عبور شما با موفقیت تغییر و به گوشی همراه شما ارسال شد.")
                        }, 2e3)
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function() {
    KTLoginGeneral.init()
});