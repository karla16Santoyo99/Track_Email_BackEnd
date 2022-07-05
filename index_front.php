
<?php
 
 $connect = new PDO("mysql:host=localhost;dbname=testing", 'root','');
 $base_url = 'http://localhost/phpmyadmin/index.php?route=/table/structure/save';
 $message = '';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

 if(isset($_POST["send"]))
 {
   require 'class/class.phpmailer.php';
     $mail = new PHPMailer(true);
     $mail->IsSMTP();
     $mail->Host = 'mail.digitaleriamx.com';
     $mail->Port = '465';
     $mail->SMTPAuth = true;
     $mail->Username = 'mailing@digitaleriamx.com';
     $mail->Password = 'NJCf@jEK3&8';
     $mail->SMTPSecure = ;
     $mail->From = 'Digitaleria';
     $mail->FromName = 'wp.digitaleriamx.com';
     $mail->AddAddress($_POST["receiver_email"]);
     $mail->WordWrap = 50;
     $mail->IsHTML(true);
     $mail->Subject = $_POST['email_subject'];
 
   
 
  $track_code = md5(rand());
 
  $message_body = $_POST['email_body'];
 
  $message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
  $mail->Body = $message_body;
 
  if($mail->Send())
  {
   $data = array(
    ':email_subject'   =>  $_POST["email_subject"],
    ':email_body'    =>  $_POST["email_body"],
    ':email_address'   =>  $_POST["receiver_email"],
    ':email_track_code'   =>  $track_code
   );
 
   // var_dump($data);
   // exit();
   $query = "
   INSERT INTO email_data 
   (email_subject, email_body, email_address, email_track_code) VALUES 
   (:email_subject, :email_body, :email_address, :email_track_code)
   ";
 
   $statement = $connect->prepare($query);
   if($statement->execute($data))
   {
    $message = '<label class="text-success">Correo electrónico enviado con éxito</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger">Correo electrónico no se ha enviado con éxito</label>';
  }
 
 }
 
 function fetch_email_track_data($connect)
 {
  $query = "SELECT * FROM email_data ORDER BY email_id";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $total_row = $statement->rowCount();
  $output = '
  <div class="table-responsive">
   <table class="table table-bordered table-striped">
    <tr>
     <th width="25%">Email</th>
     <th width="45%">Objeto</th>
     <th width="10%">Status</th>
     <th width="20%">Fecha</th>
    </tr>
  ';
  if($total_row > 0)
  {
   foreach($result as $row)
   {
    $status = '';
    if($row['email_status'] == 'yes')
    {
     $status = '<span class="label label-success">abierto</span>';
    }
    else
    {
     $status = '<span class="label label-danger">no abierto</span>';
    }
    $output .= '
     <tr>
      <td>'.$row["email_address"].'</td>
      <td>'.$row["email_subject"].'</td>
      <td>'.$status.'</td>
      <td>'.$row["email_open_datetime"].'</td>
     </tr>
    ';
   }
  }
  else
  {
   $output .= '
   <tr>
    <td colspan="4" align="center">No se encontraron datos de envío de correo electrónico</td>
   </tr>
   ';
  }
  $output .= '</table>';
  return $output;
 }
 
 
 
 ?>
 <!DOCTYPE html>
 <html>
  <head>
   <title>Rastreo de Email usando PHP</title>
   <script src="jquery.min.js"></script>
   <link rel="stylesheet" href="bootstrap.min.css" />
   <script src="bootstrap.min.js"></script>
  </head>
  <body>
   <br />
   <div class="container">
    <h3 align="center">Rastreo de email PHP</h3>
    <br />
    <?php
    
   echo $message;
 
    ?>
    <form method="post">
     <div class="form-group">
      <label>Ingrese el asunto del correo electrónico</label>
      <input type="text" name="email_subject" class="form-control" required />
     </div>
     <div class="form-group">
      <label>Ingrese el correo electrónico del destinatario</label>
      <input type="email" name="receiver_email" class="form-control" required />
     </div>
     <div class="form-group">
      <label>Ingrese información</label>
      <textarea name="email_body" required rows="5" class="form-control"></textarea>
     </div>
     <div class="form-group">
      <input type="submit" name="send" class="btn btn-info" value="Enviar Email" />
     </div>
    </form>
    
    <br />
    <form method="put">
    <h4 align="center">Status del correo</h4>
 </from>
    <?php 
    
   echo fetch_email_track_data($connect);
 
    ?>
   </div>
   <br />
   <br />
  </body>
 </html>