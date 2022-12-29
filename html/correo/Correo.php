<?php

namespace correo;

use \PHPMailer\PHPMailer\PHPMailer as phpmailer;

require __DIR__ . "/../../vendor/autoload.php";

class Correo {

    function leer_configCorreo($nombre, $esquema) {
        $config = new \DOMDocument();
        $config->load($nombre);
        $res = $config->schemaValidate($esquema);
        if ($res === FALSE) {
            throw new \InvalidArgumentException("Revise fichero de configuración");
        }
        $datos = simplexml_load_file($nombre);
        $usu = $datos->xpath("//usuario");
        $clave = $datos->xpath("//clave");
        $resul = [];
        $resul[] = $usu[0];
        $resul[] = $clave[0];
        return $resul;
    }

    function enviar_correos_account($correo, $asunto) {

        $cuerpo = $this->crear_correo_account();
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo_finalizado($correo, $asunto, $precio) {

        $cuerpo = $this->crear_correo_finalizado($precio);
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo_peza($correo, $asunto) {

        $cuerpo = $this->crear_correo_peza();
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo_pendente_cliente($correo, $asunto) {

        $cuerpo = $this->crear_correo_pendente_cliente();
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo_cuenta_sat($correo, $asunto, $rol) {

        $cuerpo = $this->crear_correo_cuenta_sat($rol);
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo_contrasena($correo, $asunto) {

        $cuerpo = $this->crear_correo_contrasena();
        return $this->enviar_correo($correo, $cuerpo, $asunto);
    }

    function enviar_correo($correo, $cuerpo, $asunto) {

        $res = $this->leer_configCorreo(__DIR__ . "/../../config/correo.xml", __DIR__ . "/../../config/correo.xsd");
        $mail = new phpmailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;  // cambiar a 1 o 2 para ver errores
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = $res[0];  //usuario de gmail
        $mail->Password = $res[1]; //contraseña de gmail          
        $mail->SetFrom('satpanel.info@gmail.com', 'SAT Panel');
        $mail->Subject = utf8_decode($asunto);
        $mail->MsgHTML($cuerpo);
        $mail->addAddress($correo);
        if (!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {
            return TRUE;
        }
    }

    function crear_correo_account() {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Bienvenido a informática Pepe!</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/correo/informatica_pepe.png' alt='logo' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; margin-bottom: 1rem; display: block; max-width: 100%;' />
                                <div class='hr'
                                  style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Confirmaci&oacute;n de registro.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'>Acabas de ser registrado con &eacute;xito en nuestro sistema, a partir de ahora podr&aacute;s estar al tanto de todos los pasos de tu reparaci&oacute;n.<br/>Ser&aacute;s notificado cuando tu reparaci&oacute;n est&eacute;
                                    lista o cuando necesitemos que contactes con nosotros.</p>
                                  <div class='button'>
                                    <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td>
                                          <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                            <tr>
                                              <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='https://google.com' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>Inform&aacute;tica Pepe &#x1F3E8;</span></a></td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>Inform&aacute;tica Pepe &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>";
        return $texto;
    }

    function crear_correo_finalizado($precio) {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Reparación Finalizada!</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/correo/informatica_pepe.png' alt='Informática Pepe' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; margin-bottom: 1rem; display: block; max-width: 100%;'
                                />
                                <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Reparaci&oacute;n finalizada.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'> Su reparaci&oacute;n ya est&aacute; finalizada. <br/> Ya puede recoger su equipo.
                                    <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                      <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                        <tr>
                                          <td> <![endif]-->
                                            <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                              <tr class='hr__row'>
                                                <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                              </tr>
                                            </table> <!--[if mso | IE]> </td>
                                        </tr>
                                      </table> <![endif]--> </div> Precio: $precio &euro; <br/><br/>
                                    <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                      <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                        <tr>
                                          <td> <![endif]-->
                                            <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                              <tr class='hr__row'>
                                                <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                              </tr>
                                            </table> <!--[if mso | IE]> </td>
                                        </tr>
                                      </table> <![endif]--> </div> Horario:<br/> Lunes-Viernes 10:00-14:00 / 16:00 - 20:00 <br/> S&aacute;bado 9:00-13:00</p>
                                  <div class='button'>
                                    <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td>
                                          <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                            <tr>
                                              <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='https://google.com' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>Inform&aacute;tica Pepe &#x1F3E8;</span></a></td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>Inform&aacute;tica Pepe &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>
";
        return $texto;
    }

    function crear_correo_peza() {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Información sobre su reparación.</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/correo/informatica_pepe.png' alt='Informática Pepe' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; margin-bottom: 1rem; display: block; max-width: 100%;'
                                />
                                <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Reparaci&oacute;n pendiente de pieza.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'> Actualmente su reparaci&oacute;n se encuentra pendiente de pieza, esto puede ocasionar un retraso en el tiempo total de la reparaci&oacute;n.
                                    <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                      <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                        <tr>
                                          <td> <![endif]-->
                                            <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                              <tr class='hr__row'>
                                                <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                              </tr>
                                            </table> <!--[if mso | IE]> </td>
                                        </tr>
                                      </table> <![endif]--> </div>
                                    <div class='button'>
                                      <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                        <tr>
                                          <td>
                                            <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                              <tr>
                                                <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='https://google.com' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>Inform&aacute;tica Pepe &#x1F3E8;</span></a></td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    </div>
                                  </p>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>Inform&aacute;tica Pepe &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>
";
        return $texto;
    }

    function crear_correo_pendente_cliente() {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Información importante sobre su reparación.</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/correo/informatica_pepe.png' alt='Informática Pepe' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; margin-bottom: 1rem; display: block; max-width: 100%;'
                                />
                                <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Reparaci&oacute;n pendiente de cliente.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'> Actualmente su reparaci&oacute;n se encuentra parada, necesitamos que contacte con nosotros lo antes posible para poder avanzar con la reparaci&oacute;n. <br/>
                                    <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                      <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                        <tr>
                                          <td> <![endif]-->
                                            <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                              <tr class='hr__row'>
                                                <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                              </tr>
                                            </table> <!--[if mso | IE]> </td>
                                        </tr>
                                      </table> <![endif]--> </div> Horario:<br/> Lunes-Viernes 10:00-14:00 / 16:00 - 20:00 <br/> S&aacute;bado 9:00-13:00</p>
                                  <div class='button'>
                                    <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td>
                                          <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                            <tr>
                                              <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='https://google.com' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>Inform&aacute;tica Pepe &#x1F3E8;</span></a></td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>Inform&aacute;tica Pepe &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>";
        return $texto;
    }

    function crear_correo_cuenta_sat($rol) {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Cuenta Creada</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/logo_1920x1080.png' alt='Informática Pepe' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; display: block; max-width: 100%;'
                                />
                                <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Cuenta creada con &eacute;xito.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'>A partir de ahora podr&aacute; disfrutar de todas las ventajas que ofrece SAT Panel. <br/> El rol asginado a su cuenta es: $rol. <br/> Haga click en el siguiente bot&oacute;n para acceder al panel.
                                    <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
                                    <br/>
                                      <div class='button'>
                                        <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td>
                                              <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                                <tr>
                                                  <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='http://satpanel.teis25.dewordpress.org/' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>SAT Panel &#x1F3E8;</span></a></td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </div>
                                    </p>
                                  </p>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>SAT Panel &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>";
        return $texto;
    }

    function crear_correo_contrasena() {
        $texto = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' />
<html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
  <head> </head>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <meta name='x-apple-disable-message-reformatting' />
    <!--[if !mso]><!-->
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <!--<![endif]-->
    <style type='text/css'>
      * {
        text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -moz-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }

      html {
        height: 100%;
        width: 100%;
      }

      body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        mso-line-height-rule: exactly;
      }

      div[style*='margin: 16px 0'] {
        margin: 0 !important;
      }

      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }

      img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }

      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }

      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    </style>
    <!--[if gte mso 9]>
      <style type='text/css'>
      li { text-indent: -1em; }
      table td { border-collapse: collapse; }
      </style>
      <![endif]-->
    <title>Cambio de Contraseña</title>
    <!-- content -->
    <!--[if gte mso 9]><xml>
       <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
       </o:OfficeDocumentSettings>
      </xml><![endif]-->
  </head>
  <body class='body' style='background-color: #FFF5EA; margin: 0; width: 100%;'>
    <table class='bodyTable' role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0' style='width: 100%; background-color: #FFF5EA; margin: 0;' bgcolor='#FFF5EA'>
      <tr>
        <td class='body__content' align='left' width='100%' valign='top' style='color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
          <div class='container' style='margin: 0 auto; max-width: 600px; width: 100%;'> <!--[if mso | IE]>
            <table class='container__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto;width: 600px' width='600' align='center'>
              <tr>
                <td> <![endif]-->
                  <table class='container__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='container__row'>
                      <td class='container__cell' width='100%' align='left' valign='top'>
                        <div class='row'>
                          <table class='row__table' width='100%' align='center' role='presentation' border='0' cellpadding='0' cellspacing='0' style='table-layout: fixed;'>
                            <tr class='row__row'>
                              <td class='column col-sm-12' width='600' style='width: 100%' align='left' valign='top'> <img src='http://satpanel.teis25.dewordpress.org/images/logo_1920x1080.png' alt='Informática Pepe' border='0' class='img__block' style='width: 50%; margin-right: auto; margin-left: auto; display: block; max-width: 100%;'
                                />
                                <div class='hr' style='margin: 0 auto; width: 100%;'> <!--[if mso | IE]>
                                  <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                                    <tr>
                                      <td> <![endif]-->
                                        <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                          <tr class='hr__row'>
                                            <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                          </tr>
                                        </table> <!--[if mso | IE]> </td>
                                    </tr>
                                  </table> <![endif]--> </div>
                                <h2 class='titulo header h2' style='margin: 20px 0; line-height: 30px; font-family: Helvetica,Arial,sans-serif; color: #0000FF; text-align: center;'>Cambio de contrase&ntilde;a.</h2>
                                <div class='columna' style='margin-right: 2em; text-align: center;'>
                                  <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 16pt; text-align: center;'>Cambio de contrase&ntilde;a realizado con &eacute;xito. <br/><br/> Haga click en el siguiente bot&oacute;n para acceder al panel.
                                    <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; font-size: 16px; line-height: 20px;'>
                                    <br/>
                                      <div class='button'>
                                        <table role='presentation' width='100%' align='left' border='0' cellpadding='0' cellspacing='0'>
                                          <tr>
                                            <td>
                                              <table role='presentation' width='auto' align='center' border='0' cellspacing='0' cellpadding='0' class='button__table' style='margin: 0 auto; margin-bottom: 2em;'>
                                                <tr>
                                                  <td align='center' class='button__cell' style='background-color: #2097E4; border-radius: 3px; padding: 6px 12px;' bgcolor='#2097E4'><a href='https://google.com' class='button__link' style='background-color: #2097E4; color: #FFFFFF; text-decoration: none; display: inline-block;'><span class='button__text' style='color: #FFFFFF; text-decoration: none;'>SAT Panel &#x1F3E8;</span></a></td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </div>
                                    </p>
                                  </p>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                        <div class='hr' style='margin: 0 auto; width: 100%; margin-top: 1em;'> <!--[if mso | IE]>
                          <table class='hr__table__ie' role='presentation' border='0' cellpadding='0' cellspacing='0' style='margin-right: auto; margin-left: auto; width: 100%;' width='100%' align='center'>
                            <tr>
                              <td> <![endif]-->
                                <table class='hr__table' role='presentation' border='0' align='center' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'>
                                  <tr class='hr__row'>
                                    <td class='hr__cell' width='100%' align='left' valign='top' style='border-top: 1px solid #9A9A9A;'>&nbsp;</td>
                                  </tr>
                                </table> <!--[if mso | IE]> </td>
                            </tr>
                          </table> <![endif]--> </div>
                        <p class='text p' style='display: block; margin: 14px 0; color: #000000; font-family: Helvetica,Arial,sans-serif; line-height: 20px; font-size: 20pt; font-weight: 700; text-align: center;'>SAT Panel &#xa9; 2021</p>
                      </td>
                    </tr>
                  </table> <!--[if mso | IE]> </td>
              </tr>
            </table> <![endif]--> </div>
        </td>
      </tr>
    </table>
    <div style='display:none; white-space:nowrap; font-size:15px; line-height:0;'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
  </body>
</html>";
        return $texto;
    }

}