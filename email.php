<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>xxxxxxxxxxxxxxxxxxxx</title>
</head>
<body>
<?php
require_once("config.php");
?>
<?php
//$cpd   = $_POST['cpf'];
//$email = $_POST['email'];
include ('conexao.php');
include('chave.php');
$sql = "SELECT * FROM email_mkt WHERE campo = campo ";
   $row_cns_email = '';
   $row_cns_email = odbc_exec($conexao, $sql) ;
  
  
require("class.smtp.php");
require("class.phpmailer.php");
$paraseq = odbc_result($row_cns_email, "ID_mkt");
$paranomemanual = odbc_result($row_cns_email, "ID_nome");
$paraemailmanual = odbc_result($row_cns_email, "ID_email") ;
$sit_email = odbc_result($row_cns_email, "ID_sit_email") ;
$sit_descurso = odbc_result($row_cns_email, "ID_matricula") ;
$emailremetente = "webmaster@lusiada.br";
$decriptado = $paraseq;
$encriptado = mcrypt_encrypt(MCRYPT_BLOWFISH, $chave, $decriptado, MCRYPT_MODE_ECB);
$base64codic = base64_encode($encriptado);
$codificadaemail = $base64codic;
$mail = new PHPMailer();
$mail->IsSMTP();
$header = "MIME-Version: 1.0\n";
$header .= "Content-type: text/html; charset=iso-8859-1\n";
$header .= "From: $paraemailmanual\n";
$mail->Host = "smtp.xxxxx.br";
$mail->SMTPAuth = true;
$mail->Username = 'login';
$mail->Password = 'senha';
$mail->From = $emailremetente;
$mail->FromName = 'xxxxxxxxxxxxxxxxxxxx';
$mail->AddAddress($paraemailmanual, $paranomemanual);
$mail->ConfirmReadingTo = $emailremetente;
$mail->IsHTML(true);
$mail->CharSet = 'iso-8859-1';
$mail->Subject  = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$pagina = file_get_contents('http://www.xxxxxxxxxxxxxxx.com.br/xxxxx.php?id='.$codificadaemail);
$mail->Body = $pagina ;
$enviado = $mail->Send();
$mail->ClearAllRecipients();
$mail->ClearAttachments();
if ($enviado)
   {
   header("Location: ./mensagem1.php");
   }
   else
   {
   echo "Não foi possível enviar o e-mail.";
   }
odbc_close ($conexao);   
?>
<!-- <script language="Javascript">  window.close() </script>  -->
</body>
</html>