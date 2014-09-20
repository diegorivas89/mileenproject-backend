<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>MiLEEM - Ingresar</title>
        <meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more."/>
        <meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
        <meta name="copyright" content="ZURB, inc. Copyright (c) 2014"/>
        <link rel="stylesheet" href="../assets/libs/foundation/css/foundation.css"/>
        <script src="../assets/libs/foundation/js/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
        <style type="text/css">
        div.row.footer{
          position: relative;
          margin-top: 130px;
        }
          div.row.footer > div{
                position:absolute;
                top:0;
                width: 100%;
                max-width: 62.5rem;
                color: white;
          }
          body{
            background: url('/assets/img/background.jpg'); 
             background-size: cover;

              background-repeat: no-repeat;
              background-attachment: fixed;
              background-position: center; 
          }
        </style>
    </head>
    <body style="">
        <div class="row">
          <div class="large-12 columns">
            <div class="row" style="text-align: center;">
              <div class="large-3 small-12 columns">&nbsp;</div>
              <div class="large-6 small-12 columns"><img src="/assets/img/logo_mileen.png" alt=""></div>
              <div class="large-3 small-12 columns">&nbsp;</div>
            </div>
            <div class="row">
              <div class="large-3 small-12 columns">&nbsp;</div>
              <div class="large-6 small-12 columns">
                <div class="panel radius" style="box-shadow: 7px 7px 8px 2px lightgray;">
                    <div class="row">
                      <div class="large-12 columns">
                        <label>Nombre
                          <input type="text" placeholder="" />
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="large-12 columns">
                        <label>Email
                          <input type="text" placeholder="" />
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="large-12 columns">
                        <label>Telefono
                          <input type="text" placeholder="" />
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="large-12 columns">
                        <label>Contraseña
                          <input type="password" placeholder="" />
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="large-12 columns">
                        <label>Confirmar Contraseña
                          <input type="password" placeholder="" />
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="large-12 columns text-right">
                        <a href="login.html" class="button secondary">Cancelar</a>
                        <input type="submit" value="Crear" class="button"/>
                      </div>
                    </div>
                </div>
              </div>
              <div class="large-3 small-12 columns">&nbsp;</div>
            </div>
          </div>
         
        </div>
         <div class="row footer">
          <div class="large-12">
            <div class="large-12 columns">
                <hr>
                <div class="row">
                    <div class="large-6 columns">
                        <p>© MiLEEM 2014</p>
                    </div>
                </div>
            </div>
          </div>
            
        </div>
        </div>
        <script>
            document.write('<script src=' +
            ('__proto__' in {} ? '//cdnjs.cloudflare.com/ajax/libs/zepto/1.1.4/zepto.min.js' : 'https://code.jquery.com/jquery-2.1.1.min.js') +
            '><\/script>')
        </script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="/assets/libs/foundation/js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
        <script>
            $(document).foundation();

            var doc = document.documentElement;
            doc.setAttribute('data-useragent', navigator.userAgent);
        </script>
    </body>
</html>