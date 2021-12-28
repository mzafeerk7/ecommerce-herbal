        <!-- Breadcumb area Start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Contact Us</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li class="current"><a href="<?= base_url().'contact' ?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb area End -->

        <!-- Main Wrapper Start -->
        <div class="main-content-wrapper">
            <!-- Google Map Start -->
            <!-- Google Map End -->

            <!-- Contact Area Start -->
            <div class="contact-area ptb--80 ptb-md--60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="heading-secondary border-bottom mb--30">Get in touch</h2>
                            <form class="form form--contact" id="contact-form" action="https://demo.hasthemes.com/mirora-preview/mirora/mail.php">
                                <div class="form-row mb--20">
                                    <div class="col-md-2 text-md-right">
                                        <label for="contact_name">Your Name <sup>*</sup></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="contact_name" id="contact_name" class="form__input form__input--3">
                                    </div>
                                </div>
                                <div class="form-row mb--20">
                                    <div class="col-md-2 text-md-right">
                                        <label for="contact_name">Your Email <sup>*</sup></label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="email" name="contact_email" id="contact_email" class="form__input form__input--3">
                                    </div>
                                </div>
                                <div class="form-row mb--20">
                                    <div class="col-md-2 text-md-right">
                                        <label for="contact_name">Enquiry <sup>*</sup></label>
                                    </div>
                                    <div class="col-md-10">
                                        <textarea name="contact_message" id="contact_message" class="form__input form__input--3 form__input--textarea"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="form__submit">Send Email</button>
                                    </div>
                                </div>
                                <div class="form__output"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Area End -->
        </div>
        <!-- Main Wrapper End -->