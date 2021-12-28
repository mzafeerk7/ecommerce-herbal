<!-- Breadcumb area Start -->

        <!-- Breadcumb area End --> 

        <!-- Main content wrapper start -->
        <div class="main-content-wrapper">
            <div class="checkout-area pt--40 pb--80 pt-md--30 pb-md--60">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-6 offset-sm-3">
                            <!-- Checkout Area Start -->
                            <div class="checkout-wrapper bg--2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="checkout-title text-center">
                                            <h2>Your Account</h2>
                                            <div id="result"></div>
                                        </div>
                                        <div class="checkout-form">
                                            <form id="login_register_form">
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-sm-12">
                                                        <label for="username" class="form__label">Username <span>*</span></label>
                                                        <input type="text" name="username" id="username" class="form__input form__input--2 error">
                                                        <span class="small text-danger"><p></p></span>
                                                    </div>
                                                    <div class="form__group col-sm-12 mt-3">
                                                        <label for="password" class="form__label">Password <span>*</span></label>
                                                        <input type="password" name="password" id="password" class="form__input form__input--2 error">
                                                        <span class="small text-danger"></span>
                                                    </div>

                                                    <!-- for login -->
                                                    <div class="form__group col-sm-12 pb-4" style="border-bottom: 1px solid #2d2d2d;">
                                                        <button type="button"  onclick="_account.login();" class="btn btn-medium btn-style-1 btn-block mt-5">login</button>
                                                    </div>

                                                    <div style="padding: 0em 1em;">
                                                        <p style="color: #a8741a !important; text-align: justify;">If don't have an account. Enter Username & Password in the above field and click Create Account.</p>
                                                    </div>
                                                    
                                                    <div class="form__group col-sm-12 ">
                                                        <button type="button" onclick="_account.register();" class="btn btn-medium btn-style-1 btn-block mt-3">Create Account</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Checkout Area End -->
                        </div>
                    </div>
                </div>     
            </div>
        </div>
        <!-- Main content wrapper end -->