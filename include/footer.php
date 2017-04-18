<?php $kontak = getKontak(); 

$your_email = $kontak['email'];// <<=== update to your email address
$errors = '';
//$name = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
    
    //$name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $user_message = $_POST['message'];
    ///------------Do Validations-------------
    if(empty($visitor_email))
    {
        $errors .= "\n Email are required fields. ";   
    }
    if(IsInjected($visitor_email))
    {
        $errors .= "\n Bad email value!";
    }
    if(empty($_SESSION['6_letters_code'] ) ||
      strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
    {
    //Note: the captcha code is compared case insensitively.
    //if you want case sensitive match, update the check above to
    // strcmp()
        $errors .= "\n The captcha code does not match!";
        echo "<script>alert('The captcha code does not match !'); window.location='#social-buttons4-c'</script>";
    }
    
    if(empty($errors))
    {
        //send the email
        $to = $your_email;
        $subject="New form submission";
        $from = $your_email;
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        
        $body = "A user  $name submitted the contact form:\n".
        "Email: $visitor_email \n".
        "Message: \n ".
        "$user_message\n".
        "IP: $ip\n";    
        
        $headers = "From: $from \r\n";
        $headers .= "Reply-To: $visitor_email \r\n";
        
        mail($to, $subject, $body,$headers);
        
        echo "<script>alert('Pesan terkirim !'); window.location='#social-buttons4-c'</script>";
    }
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
<section class="mbr-section mbr-section-md-padding" id="social-buttons4-c" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 00px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-xs-center">
                <h3 class="mbr-section-title display-2">FOLLOW US</h3>
                <div>
                    <a class="btn btn-social" title="Twitter" target="_blank" href="https://www.twitter.com/<?php echo $kontak['twitter']; ?>">
                        <i class="socicon socicon-twitter"></i>
                    </a>
                    <a class="btn btn-social" title="Facebook" target="_blank" href="<?php echo $kontak['facebook']; ?>">
                        <i class="socicon socicon-facebook"></i>
                    </a>
                    <a class="btn btn-social" title="Google+" target="_blank" href="<?php echo $kontak['google']; ?>">
                        <i class="socicon socicon-googleplus"></i>
                    </a>
                    <a class="btn btn-social" title="YouTube" target="_blank" href="<?php echo $kontak['youtube']; ?>">
                        <i class="socicon socicon-youtube"></i>
                    </a>
                    <a class="btn btn-social" title="Instagram" target="_blank" href="https://www.instagram.com/<?php echo $kontak['instagram']; ?>">
                        <i class="socicon socicon-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-footer mbr-section mbr-section-md-padding" id="contacts3-2" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">
    <div class="row">
        <div class="mbr-company col-xs-12 col-md-6 col-lg-3">   
            <div class="mbr-company card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span class="list-group-icon"><span class="etl-icon icon-phone mbr-iconfont-company-contacts3"></span></span>
                        <span class="list-group-text"><?php echo $kontak['phone']; ?></span>
                    </li>
                    <li class="list-group-item">
                        <span class="list-group-icon"><span class="etl-icon icon-map-pin mbr-iconfont-company-contacts3"></span></span>
                        <span class="list-group-text"><?php echo $kontak['kontak']; ?></span>
                    </li>
                    <li class="list-group-item active">
                        <span class="list-group-icon"><span class="etl-icon icon-envelope mbr-iconfont-company-contacts3"></span></span>
                        <span class="list-group-text"><a href="mailto:<?php echo $kontak['email']; ?>"><?php echo $kontak['email']; ?></a></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
            <h4>Kategori</h4>
            <ul>
                <?php 
                $qKat = getKategori();
                while($kategori = $qKat->fetch(PDO::FETCH_ASSOC)){ ?>
                <li><a class="text-white" href="<?php echo "?page=berita&kategori=$kategori[id_kategori]" ?>">
                <?php echo $kategori['kategori']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="mbr-footer-content col-xs-12 col-md-6 col-lg-3">
            <h4>Maps</h4>
            <?php echo $kontak['maps']; ?>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3" data-form-type="formoid">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="contact_form">
                <div class="form-group">
                    <label class="form-control-label" for="contacts3-2-email">Email<span class="form-asterisk">*</span></label>
                    <input type="email" class="form-control input-sm input-inverse" name="email" required="" data-form-field="Email" id="contacts3-2-email" value="<?php echo htmlentities($visitor_email) ?>">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="contacts3-2-message">Message</label>
                    <textarea class="form-control input-sm input-inverse" name="message" data-form-field="Message" rows="5" id="contacts3-2-message"><?php echo htmlentities($user_message) ?></textarea>
                </div>
                <div class="form-group">
                    <img src="assets/captcha/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
                    <label for='message'>Enter the code above here :</label><br>
                    <input class="form-control" id="6_letters_code" name="6_letters_code" type="text" required=""><br>
                    <small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
                </div>
                <div><button type="submit" name="submit" class="btn btn-sm btn-black">Contact us</button></div>
            </form>
        </div>
    </div>
</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-2" style="background-color: rgb(50, 50, 50); padding-top: 1.75rem; padding-bottom: 1.75rem;">
    <div class="container">
        <p class="text-xs-center">Copyright (c) 2016 Mobirise.</p>
    </div>
</footer>
<input name="animation" type="hidden">
<script language="JavaScript">
    // Code for validating the form
    // Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
    // for details
    var frmvalidator  = new Validator("contact_form");
    //remove the following two lines if you like error message box popups
    frmvalidator.EnableOnPageErrorDisplaySingleBox();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("message","req","Please provide your message"); 
    frmvalidator.addValidation("email","req","Please provide your email"); 
    frmvalidator.addValidation("email","email","Please enter a valid email address"); 
    </script>
    <script language='JavaScript' type='text/javascript'>
    function refreshCaptcha()
    {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
</script>

<?php
function getKontak(){
    $sql_kontak = "SELECT *FROM kontak ORDER BY id_kontak DESC LIMIT 1";
    $kontak = PdoSelect($sql_kontak);

    return $kontak;
}
?>