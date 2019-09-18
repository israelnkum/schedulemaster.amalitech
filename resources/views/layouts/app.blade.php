<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AMALITECH - Schedule Master') }}</title>
    <link rel="stylesheet" href="{{asset('public/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">
</head>
<body>
@yield('content')

<!-- container-scroller -->
<!-- base:js -->
<script src="{{asset('public/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('public/assets/bundles/libscripts.bundle.js')}}"></script>

<script src="{{asset('public/assets/js/pages/forms/jquery.validate.js')}}"></script> <!-- Jquery Validation Plugin Css -->
<script src="{{asset('public/assets/js/pages/forms/jquery.steps.js')}}"></script> <!-- JQuery Steps Plugin Js -->

<script src="{{asset('public/assets/js/pages/forms/form-wizard.js')}}"></script>
<script src="{{asset('public/js/jquery.inputmask.bundle.js')}}"></script>
<script src="{{asset('public/js/inputmask.binding.js')}}"></script>
<script src="{{asset('public/js/mask.init.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('public/js/off-canvas.js')}}"></script>
<script src="{{asset('public/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/js/template.js')}}"></script>
<script src="{{asset('public/js/settings.js')}}"></script>
<script src="{{asset('public/js/todolist.js')}}"></script>
{{--<script src="{{asset('public/js/select2.min.js')}}"></script>
<script src="{{asset('public/js/select2.js')}}"></script>--}}

<script>


    $('#selected_id').change(function () {
        //Voters ID
        if ($('#selected_id').val() === "Voters"){
            $('#voters_id').fadeIn(1000).slideDown(1000);
            $('#voters_id').removeAttr('disabled');
            $(".voters_id").on('keyup', function() {
                let str = $(".voters_id").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });
        }else{
            $('#voters_id').fadeOut(1000).slideUp(1000);
            $('#voters_id').attr('disabled', true);
        }

        //Ghana Card
        if ($('#selected_id').val() === "Ghana card"){
            $('#ghana_card').fadeIn(1000).slideDown(1000);
            $('#ghana_card').removeAttr('disabled');

            $(".ghana-card").on('keyup', function() {
                let str = $(".ghana-card").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });

        }else{
            $('#ghana_card').fadeOut(1000).slideUp(1000);
            $('#ghana_card').attr('disabled', true);
        }

        //NHIS
        if ($('#selected_id').val() === "NHIS"){
            $('#nhis').fadeIn(1000).slideDown(1000);
            $('#nhis').removeAttr('disabled');

            $(".nhis").on('keyup', function() {
                let str = $(".nhis").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });

        }else{
            $('#nhis').fadeOut(1000).slideUp(1000);
            $('#nhis').attr('disabled', true);
        }

        //SSNIT
        if ($('#selected_id').val() === "SSNIT"){
            $('#ssnit').fadeIn(1000).slideDown(1000);
            $('#ssnit').removeAttr('disabled');

            $(".ssnit").on('keyup', function() {
                let str = $(".ssnit").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });
        }else{
            $('#ssnit').fadeOut(1000).slideUp(1000);
            $('#ssnit').attr('disabled', true);
        }

        //Passport

        if ($('#selected_id').val() === "Passport"){
            $('#passport-id').fadeIn(1000).slideDown(1000);
            $('#passport-id').removeAttr('disabled');

            $(".passport-id").on('keyup', function() {
                let str = $(".passport-id").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });

        }else{
            $('#passport-id').fadeOut(1000).slideUp(1000);
            $('#passport-id').attr('disabled', true);
        }

        //Old Driver's licence
        if ($('#selected_id').val() === "Old Driver's licence"){
            $('#old-drivers-license').fadeIn(1000).slideDown(1000);
            $('#old-drivers-license').removeAttr('disabled');


            $(".old-drivers-license").on('keyup', function() {
                let str = $(".old-drivers-license").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });

        }else{
            $('#old-drivers-license').fadeOut(1000).slideUp(1000);
            $('#old-drivers-license').attr('disabled', true);
        }

        //New Driver's licence
        if ($('#selected_id').val() === "New Driver's licence"){
            $('#new-drivers-license').fadeIn(1000).slideDown(1000);
            $('#new-drivers-license').removeAttr('disabled');

            $(".new-drivers-license").on('keyup', function() {
                let str = $(".new-drivers-license").val();
                if (str === "" || str.indexOf('_') >= 0) {
                    $('.btn-confirm-booking').attr('disabled', true);
                }else {
                    $('.btn-confirm-booking').removeAttr('disabled');
                }
            });

        }else{
            $('#new-drivers-license').fadeOut(1000).slideUp(1000);
            $('#new-drivers-license').attr('disabled', true);
        }
        $('#voters_id').val("");
        $('#ghana_card').val("");
        $('#nhis').val("");
        $('#ssnit').val("");
        $('#passport-id').val("");
        $('#old-drivers-license').val("");
        $('#new-drivers-license').val("");
        $('.btn-confirm-booking').attr('disabled', true);
    });

    $('#schedule').change(function () {
        this.form.submit();
    });


    /*
   * Form Validation
    */
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>

