
<style>

.footer-section {
   
  width: 100%;
  padding: 15px;
  margin-right: auto;
  margin-left: auto; }

.social >ul >li{
    list-style: none;
    display: inline-block; 
    font-size: 1.5rem;
    padding: 1rem;}

.social >ul >li >a{
        color: #541D70;
    }
.social >ul >li >a >i:hover{
        transform: scale(1.2);
	    color: #110630;
    }
 .contact-sect{
        margin-right:0;
        justify-content:right;
    }

 .description-contact{
        font-size:1.5 rem;
        color: #fff;
       
    }

 .site-footer {
     color:black;
    }

 .cv-download a i{
        color: #fff;
    }
.cv-download a i:hover{
        transform: scale(1.2);
	    color: #110630;
    }
 h4{
         font-size:2rem;
         color:#541D70;
    }
</style>

<section class="footer-section">
    <div class=" row">
  <!--Social Media-->

        <div class="social col-md-5 text-center" >
            <h4> Contact details</h1>
            <div class=" description-contact text-center">
                <p>Based in Cluj-Napoca, Romania.</p>
                <p> Interested in a comission or hiring me for a job? Please send me a message using the contact form. I'll get back to you as soon as possible.</p>
                <p>Check me out on social media !</p>
            </div>
           
            <ul>
            <li><a href="https://www.facebook.com/popa.maria.98478" target="_blank"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/p.m.4all/" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com/in/popa-maria-947378181/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href=""><i class="fab fa-telegram" target="_blank"></i></a></li>
            </ul>
                    
            <p class=" description-contact text-center"> If you didn't check my CV yet, what are you waiting for ?</p>
            <div class="cv-download">
            <a href="includes/CV_Popa_Maria.pdf" download="PopaMariaCV"><i class="far fa-arrow-alt-circle-down fa-3x"></i></a>
            </div>
         </div>

        <div class=" contact-sect col-md-7">
            <!--Contact form-->
            <section id="contact">
            <?php require_once "contact.php";?>
            </section>
        </div>
    </div>
</section>


<footer class="site-footer">
    <div class="row">
        
     <div class="col-md-12 text-center">
	 <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script> Popa Maria|  All rights reserved  </p>
	</div>

</footer>

