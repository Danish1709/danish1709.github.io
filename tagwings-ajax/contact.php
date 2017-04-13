<?php require_once('header.php'); ?>
<style>
    .msgErr{
        color: crimson;
    }
    select{
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>



        <div id="header" >
			<div class="flex-container-wrapper"> <!-- IE fix for vertical alignment in flex box -->
				<div class="header-content-contact ">
					<div class="pattern-overlay">
                       
						<div class="container">
							<div class="row">
								
                                <div class="col-sm-3 col-md-3"></div>
								<div class="col-sm-6 col-md-6">
									<div class="call-to-action ">
                                        <p style="text-align:center;">TagWings</p>
										<h2>YOU FOUND IT!</h2>
										
									</div>
								</div>
                                
                                <div class="col-sm-3 col-md-3"></div>
							</div>
						</div>
					</div>
				</div>
              
			</div><!-- end of IE vertical alignment fix -->
		</div> <!-- end of header -->



		<!-- Description Section 1 -->
		<div  class="container">
			<div class="">
				<div class="row container">
					<div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="comp">GET IN TOUCH</h1><br>
                            </div>
                        </div>
                        
						<div class=" " style="text-align:justify;">
							
						</div>
                        <div class="container">
                            <p>India: +91 720 800 0816  | +91 889 856 9089 | +91 982 009 4678</p>
                           <p> US: +1 408 520 9259</p>
                            
                            <p><strong>Email:</strong> contactus@tagwings.com</p><br>
                            <p>
                        
                        <h4>TagWings Technologies Pvt Ltd.</h4>
                            8<sup>th</sup> floor, Sanjona Chambers, Govandi Station Road,<br> Opp.
                            Lakme Factory, Govandi East, Mumbai - 400 088, India.
                        </p>
                        </div>
					</div>
					<div class="col-sm-6 " >
                        <br>
						<form method="post" id="contact_form_data">
                            <div class="row">
                                <div class="form-body">
                                <div class="col-md-12 col-sm-12">
                                    <div class="alert alert-danger">
                                        <button class="close" data-dismiss="alert" data-close="alert">x</button>
                                        <span class="alert-danger-msg"></span>
                                    </div>
                                </div> 
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-12 col-sm-12">
                                    <div class="alert alert-success">
                                        <button class="close" data-dismiss="alert" data-close="alert" >x</button>
                                        <span class="alert-success-msg"></span>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" name="name" placeholder="Enter your name here ">
                                        <div class="msgErr">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="email" value="" class="form-control" name="email" placeholder="Email">
                                         <div class="msgErr">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 col-xs-4">
                                    
                                        <select class="form-control" name="country_code" id="country_code" >
                                            <option value="91" >+91</option>
                                            <option value="1">+1</option>
                                            <option value="68" >+68</option>
                                            <option value="74" >+74</option>
                                            <option value="99" >+99</option>
                                        </select>
                                   
                                    
                                </div>
                                
                                <div class="col-sm-10 col-xs-8">
                                    <div class="form-group">
                                        <input type="text" id="mobile" value=""  class="form-control" name="mobile" maxlength="12"  placeholder="Contact">
                                         <div class="msgErr">
                                            <span><?php //echo $contactErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea type="text"  class="form-control" cols="10" rows="5" name="message" id="message" placeholder="Message"><?php //echo $message ?>
                                        </textarea>
                                         <div class="msgErr">
                                            <span><?php //echo $messageErr; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group" id="pre-loader">
                                        <input type="button" class="form-control btn btn-default btn-submit" name="contact_submit" id="contact_submit" value="SUBMIT"><span class="invisible-preloader"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                </div>
                                <!--<div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="reset" class="form-control btn btn-danger btn-cancel" name="reset" value="CANCEL">
                                        
                                    </div>
                                </div>-->
                            </div>
                           
                        </form>
                        
					</div>
				</div>
			</div>
		</div> <!-- end of description section 1 -->
		
			
<br>
		
    <!--include footer here-->
        <?php require_once('footer.php'); ?>