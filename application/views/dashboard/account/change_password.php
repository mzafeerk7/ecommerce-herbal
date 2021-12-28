<!-- Page Inner -->
<div class="page-inner">
    <!-- <div class="page-title">
        <h3 class="breadcrumb-header">Add Product</h3>
    </div> -->
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-darkblue" style="margin-top: 2em;">
                    <div class="panel-heading clearfix">
                        <div id="result"></div>
                        <h2 class="panel-title">Change Password</h2>
                    </div>
                    <div class="panel-body basic-form-panel">
                        <form id="change-password-form">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control error" name="current_password" id="current_password" placeholder="Current Password">
                                    <span class="small text-danger"></span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control error" name="new_password" id="new_password" placeholder="New Password">
                                    <span class="small text-danger"></span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control error" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                    <span class="small text-danger"></span>
                                </div>
                            </div>

                            <button type="button" onclick="_account.change_password();" class="btn  btn-default btn-lg m-b-xxs pull-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- Main Wrapper -->