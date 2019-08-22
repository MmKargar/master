import Vue from 'vue';
import VeeValidate from 'vee-validate';
import Axios from 'axios';

Vue.use(VeeValidate);
const dict = {
    custom: {
        mobile_forget: {
            'required' : 'شماره همراه الزامی است.' , 
            'mobexist' : 'شماره همراه در پایگاه داده ثبت نشده است.',
            'digits'   : 'شماره همراه باید عددی و 11 رقمی باشد.'
        },
        first_name: {
            'required': 'فیلد نام الزامی است.',
            'max': 'تعداد کاراکترهای وارد شده بیش از حد مجاز است.',
        },
        last_name: {
            'required': ' فیلد نام خانوادگی الزامی است.',
            'max': 'تعداد کاراکترهای وارد شده بیش از حد مجاز است.',
        },
        n_code: {
            'required': 'فیلد کدملی الزامی است.',
            'unique': 'کد ملی تکراری است.',
            'digits': 'کد ملی باید عددی و ده رقمی باشد.',
        },
        email: {
            'required': 'فیلد ایمیل الزامی است.',
            'unique': 'ایمیل تکراری است.',
            'email': 'قالب وارد شده ایمیل صحیح نیست.',
        },
        passwordd: {
            'required': 'فیلد کلمه عبور الزامی است.',
            'min': 'کلمه عبور باید حداقل 8 کاراکتر باشد.',
            'max': 'تعداد کاراکترهای وارد شده بیش از حد مجاز است.',
        },
        password: {
            'required': 'فیلد کلمه عبور الزامی است.',
            'max': 'تعداد کاراکترهای وارد شده بیش از حد مجاز است.',
        },
        rpassword: {
            'required': 'فیلد تکرار کلمه عبور الزامی است.',
            'confirmed': 'فیلد کلمه عبور با تکرار کلمه عبور همخوانی ندارد.',
            'max': 'تعداد کاراکترهای وارد شده بیش از حد مجاز است.',
        },
        mobilee: {
            'required': 'فیلد شماره همراه الزامی است.',
            'unique': 'شماره همراه تکراری است.',
            'digits': 'شماره همراه باید عددی و 11 رقمی باشد.',
        },
        mobile: {
            'required': 'فیلد شماره همراه الزامی است.',
        }
    }
};



const login = new Vue({
    el: '#login',
    data: {
        registring: false ,
        checking : false
    },
    methods : {
        async validate(e){
            e.preventDefault();
            this.checking = true;        
            const result = await this.$validator.validateAll();
            this.checking = false;        
            if(result){
                this.registring  = true;
                let sw = false;
                var data = {
                    'first_name' : document.getElementsByName('first_name')[0].value,
                    'last_name' : document.getElementsByName('last_name')[0].value,
                    'mobile' : document.getElementsByName('mobilee')[0].value,
                    'n_code' : document.getElementsByName('n_code')[0].value,
                    'email' : document.getElementsByName('email')[0].value,
                    'password' : document.getElementsByName('passwordd')[0].value
                }
                await Axios.post(register_route , data  )
                .then(response=> {
                    if(response.status == 200){
                        sw = true;
                    }
                })
                .catch(error=>{
                    console.log(error);
                    this.registring = false;
                });
                console.log(sw);
                if(sw){
                    await document.getElementById('kt_login_signup_submit').click();
                    setTimeout(() => {
                        this.registring = false;
                    }, 7000);
                }
            }
        }
    },
    mounted() {
        this.$validator.localize('en', dict);
    },
    created() {
        this.$validator.extend('unique', {
            //   getMessage: field => 'At least one ' + field + ' needs to be checked.',
            async validate(value, arg) {
                arg = arg[0];
                let sw = false;
                let data = {
                    'field': arg,
                    'value': value
                }
                await Axios.post(check_signup_route, data, {
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
                })
                    .then((response) => {
                        if (response.data == true) {
                            sw = true;
                        }
                    })
                    .catch(error => console.log(error));
                if (sw) {
                    return true;
                } else {
                    return false;
                }
            }
        });

    }
});


const forget = new Vue({
    el : '#forget' ,
    data: {
        sending_code      : false,
        show_verify_button: false,
        not_confirmed     : false,
        checking          : false ,
        
    },
    methods : {
        async validate(e){
            e.preventDefault();
            const result = await this.$validator.validateAll();
            if(result){
                this.sending_code = true;        
                let sw = false;
                var data = {
                    'mobile' : document.getElementsByName('mobile_forget')[0].value
                }
                mobile = document.getElementsByName('mobile_forget')[0].value;
                await Axios.post(sendcode_route , data  )
                .then(response=> {
                    if(response.status == 200){
                        sw = true;
                    }
                })
                .catch(error=>{
                    console.log(error);
                    this.sending_code  = false;
                });
                if(sw){
                    document.getElementsByName('mobile_forget')[0].value = '' ;
                    this.sending_code  = false;
                    this.show_verify_button = true;
                    setTimeout(() => {
                        document.getElementsByName('mobile_verify')[0].value = '' ;
                    }, 1000);
                }
            }
        },
        async verify(e){
            e.preventDefault();
            this.checking = true;
            this.show_verify_button = false;
            this.sending_code = false;
            let sw = false;
            var data = {
                'mobile'  : mobile,
                'code'  : document.getElementsByName('mobile_verify')[0].value
            }
            await Axios.post(confirm_code_route , data)
            .then(response => {
                if(response.data == true){
                    sw = true;
                }
            })
            .catch(error => console.log(error));
            if(sw){
                document.getElementById('kt_login_forgot_submit').click();
                setTimeout(() => {
                    this.checking = false; 
                    this.sending_code= false;
                    this.show_verify_button = false;
                    this.not_confirmed = false;
                }, 6000);
            }else{
                this.not_confirmed = true;
                this.checking = false; 
                this.sending_code= false;
                this.show_verify_button = true;
            }
        }
    },
    created(){
        this.$validator.extend('mobexist', {
            async validate(value) {
                let sw = false;
                let data = {
                    'value': value
                }
                await Axios.post(mobexist_route, data, {
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
                })
                    .then((response) => {
                        if (response.data == true) {
                            sw = true;
                        }
                    })
                    .catch(error => console.log(error));
                if (sw) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    }
});

const signin = new Vue({
    el : '#signin' ,
    data : {
        checking : false
    },
    methods : {
        async sign(){
            this.checking = true;
            var data = {
                'mobile' : document.getElementsByName('mobile')[0].value,
                'password' : document.getElementsByName('password')[0].value
            }
            await Axios.post(sign_route , data )
            .then(response=>{
                if(response.data == true){
                    console.log('responsed true');
                    document.getElementById('kt_login_signin_submited').click();
                    this.checking = false;
                    document.location.href = dashboard_route;
                }else if(response.data == 'not_activated'){
                    console.log('responsed not active');
                    document.getElementById('not_activated').click();
                    this.checking = false;
                }else{
                    console.log('responsed user pass faild');
                    this.checking = false;
                    document.getElementById('kt_login_signin_submit').click();
                }
            })
            .catch(error=>{
                this.checking = false;
                console.log(error);
            });
        }
    }
});