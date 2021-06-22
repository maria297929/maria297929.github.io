<?php 

$status = "";
if(isset($_POST['submit']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  if(empty($name) || empty($email) || empty($subject) || empty($message)) {
    $status = "All fields are compulsory.";
  } else {
    if(strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
      $status = "Please enter a valid name";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $status = "Please enter a valid email";
    } else {

      $sql = "INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)";

      $stmt = $pdo->prepare($sql);
      
      $stmt->execute(['name' => $name, 'email' => $email, 'subject' =>$subject, 'message' => $message]);

      $status = "Your message was sent";
      $name = "";
      $email = "";
      $subject ="";
      $message = "";
    }

  }
}
?>

<style>

  
.container-contact{
    display: flex;
    justify-content: center;   
}

.contact-form{
    justify-content: center;
    width:70%;
}

.form-group {
  width: 100%;
  background-color: #fff;
  border-radius: 31px;
  margin-bottom: 10px;
  z-index: 0;
  }

 
  .input {
  outline: none;
	border: none;
  position: relative;
  display: block;
  width: 100%;
  background: #fff;
  border-radius: 31px;
  
  font-size: 18px;
  color: #8f8fa1;
  line-height: 1.2;
}

input.input {
  height: 62px;
  padding: 0 35px 0 35px;
}


textarea.input {
  min-height: 169px;
  padding: 19px 35px 0 35px;
}

button {
	outline: none !important;
/*	border: none;*/
  border-color: #fff ;
	background: transparent;
}

button:hover {
	cursor: pointer;
}


  /*[ Focus Input ]*/

.focus-input {
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  border-radius: 31px;
  background-color: #fff;
  pointer-events: none;
  
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input:focus + .focus-input {
  width: calc(100% + 20px);
}

/*[ Button ]*/

.container-contact-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-top: 10px;
}

.contact-form-btn{
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    min-width: 150px;
    height: 62px;
    background-color: transparent;
    border-radius: 31px;
  
    font-family: Roboto;
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;
  
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
    position: relative;
   
}

.contact-form-btn::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  border-radius: 31px;
  background-color:#541D70;
  pointer-events: none;
  
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.contact-form-btn:hover:before {
  background-color:#541D70;
  width: calc(100% + 20px);
}

.alert-contact{
  margin-top:10px;
  border-radius:30px;
}

h4{
  
  color:#541D70;
}

@media (max-width: 992px) {
  .alert-validate::before {
    visibility: visible;
    opacity: 1;
  }
}
</style>

<h4 class="text-center">Get in touch</h4>

  <div class="container-contact" >
    
    <form action="" method="POST" class="contact-form validate-form" >
        <div class="form-row">
          
              <div class="form-group col-md-5 ">
              <input type="text" name="name" id="name" class="input" placeholder="Full Name" required>        
              <span class="focus-input"></span>
              </div>

              <div class="col-md-1"></div>

            <div class="form-group col-md-6 " >
           
            <input type="email" id="email" name="email" class="input" placeholder="E-mail"  size="30" 
            pattern="[^ @]*@[^ @]*]" required>
                <span class="focus-input"></span>
            </div>

        </div>
            
          <div class="form-group ">
          <input type="text" name="subject" id="subject" class="input" placeholder="Subject" required>
          <span class="focus-input"></span>
          </div>

          <div class="form-group " >
          <textarea name="message" id="message" class="input text" placeholder="Your Message" required ></textarea>
          <span class="focus-input"></span>
          </div>

        <div class="container-contact-form-btn">
            <button class="contact-form-btn" type="submit"  name="submit" >
              <span>
                <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
                Send
              </span>
            </button>
          </div>

  <div class='alert alert-secondary alert-contact text-center' role='alert'>
        <?php echo  $status ?>
      </div>

    </form>
   
    </div>
 