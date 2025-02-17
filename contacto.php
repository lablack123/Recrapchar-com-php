<!DOCTYPE html>
<html lang="en">
<!-- Adicione essa linha no seu HTML -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
require('cmp/head.php');
?>



<body>
    <?php require 'cmp/menu.php'; ?>
    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 text-center">
                    <h1 class="text-uppercase">Contactos</h1>
                    <p class="lead">As Tecnologias de Informação ao Serviço do Estado</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /PAGE HEADER -->

    <!-- /HEADER -->
    <!-- SECTION -->


    <div class="section">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="section-row lista">
                        <div class="section-title">
                            <h2 class="title">Informações de Contacto </h2>
                        </div>
                        <p>Instituto de Inovação e Conhecimento</p>
                        <ul class="contacto">
                            <li><i class="fa fa-phone"></i> +239-224-2650</li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:inic@inic.gov.st">inic@inic.gov.st- Entre em contacto connosco</a></li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:suporte@inic.gov.st">suporte@inic.gov.st - Email para suporte dos nossos serviços</a></li>
                            <li><i class="fa fa-map-marker"></i> Rua Salustino da Graça, Edifício do Gabinete do Primeiro Ministro, C.P. n.º 302</li>
                        </ul>
                    </div>

                    <div class="section-row">
                        <div class="section-title">
                            <h2 class="title">Fale Connosco</h2>
                        </div>
                        <form id="form-contact">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="input" type="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="input" type="text" name="subject" placeholder="Assunto">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="input" name="message" placeholder="Digite a Mensagem"></textarea>
                                    </div>
                                    <p id="alert-msg"></p>
                                    <button type="submit" class="primary-button button-primary " >Enviar</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="6Lf1ONUqAAAAAFv0db0lQbR_6EXuXVVsyGNHdRWl">


                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- social widget -->
                    <div class="aside-widget ">
                        <div class="section-title">
                            <h2 class="title">Social Media</h2>
                        </div>
                        <div class="social-widget ">
                            <ul class=" centered">
                                <li>
                                    <a href="https://www.facebook.com/inicstp/" target="_blank" class="social-facebook">
                                        <i class="fa fa-facebook"></i>
                                        <span>1.2K<br>Segue-nos</span>
                                    </a>
                                </li>
                                <!--  <li>
                                        <a href="#" class="social-twitter">
                                            <i class="fa fa-twitter"></i>
                                            <span>10.2K<br>Followers</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://myaccount.google.com/u/5/?utm_source=OGB&tab=wk&utm_medium=app" class="social-google-plus">
                                            <i class="fa fa-google-plus"></i>
                                            <span>1K<br>Followers</span>
                                        </a>
                                    </li-->
                            </ul>
                        </div>
                    </div>
                    <!-- /social widget -->

                    <!-- newsletter widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2 class="title"></h2>
                        </div>
                        <div class="newsletter-widget">
                            <img src="img/global/logo_menor.png" width="220" height="140" alt="Logo">
                        </div>
                    </div>
                    <!-- /newsletter widget -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>

    <!-- /FOOTER -->


    <!-- ScrollUp button end -->
    <!-- Include javascript -->
    <script src="assets/js/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
    $('#form-contact').on('submit', function(e) {
        e.preventDefault();
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            $('#alert-msg').text('Por favor, complete o reCAPTCHA.').css('color', 'red');
            return;
        }
        var formData = $(this).serialize() + '&g-recaptcha-response=' + recaptchaResponse;
       
        
        $.ajax({
            url: "mail.php",
            type: "POST",
            dataType: "json",
            data: formData,
            success: function(response) {
                console.log(response);
                
                if (response.status === 'sucesso') {
                    $('#alert-msg').text(response.mensagem).css('color', 'green');
                    $('#form-contact').trigger('reset');
                } else {
                    $('#alert-msg').text(response.mensagem).css('color', 'red');
                }
            },
            error: function() {
                $('#alert-msg').text('Erro na comunicação com o servidor.').css('color', 'red');
            }
        });
    });
});



    </script>

    <!-- ScrollUp button end -->
    <!-- Include javascript -->
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v2.10";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" style=" margin:0px auto; background-color:transparent; width:auto;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">INIC </h4>
                </div>
                <div class="modal-body alert-msg">
                    <p class="alert-msg">...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
   
</body>

</html>