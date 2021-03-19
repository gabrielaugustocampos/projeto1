<link rel="stylesheet" href="{{asset('assets_site/css/slick.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_site/css/bootstrap-grid.css')}}">
<link rel="stylesheet" href="{{asset('assets_site/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets_site/css/jquery.fancybox.css')}}">
<link rel="stylesheet" href="{{asset('assets_site/css/style.css')}}">
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

{{--  reCAPTCHA Site  --}}

<script type="text/javascript">

    var onloadCallback = function() {
      grecaptcha.render('RecaptchaField1', {
        'sitekey' : '6Ld1cl0aAAAAAIaNifGPovYdn4yAm08NmDI-QwVW'
      });
    };
</script>

{{--  reCAPTCHA Localhost  --}}

{{--  <script type="text/javascript">
    var onloadCallback = function() {
      grecaptcha.render('RecaptchaField1', {
        'sitekey' : '6LdyhV0aAAAAALv6AgSJnpVELPCu2dq6umHtwrPc'
      });
    };
</script>  --}}

<style>
  .alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
  }
  .alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
  }
  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
  }
  .paginacao{
    margin-top: 5em; 
  }

  .paginacao a{
    padding: 1em;
    margin-right: 0.5em;
    background-color: #fff;
    border: 1px solid red;
    border-radius: 8px;
  }

  .paginacao .active span{
    padding: 1em;
    margin-right: 0.5em;
    color: #fff;
    background-color: red;
    border: 1px solid red;
    border-radius: 8px;
  }

  .paginacao .disabled span{
    padding: 1em;
    margin-right: 0.5em;
    background-color: #fff;
    border: 1px solid red;
    border-radius: 8px;
  }

</style>
