<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Manage Categories</h3>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-darkblue">
                    <div class="panel-heading clearfix">
                        <div id="result"></div>
                        <h4 class="panel-title">Categories
                            <span class="pull-right"><button type="button" class="btn btn-default btn-addon m-b-xxs" data-toggle="modal" data-target="#add-category"><i class="fa fa-plus"></i> Add Category</button></span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="categories" class="display table table-data-width myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add Category Modal -->
                <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Category</h4>
                            </div>
                            <div class="modal-body">
                                <form id="add-category-form">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control error" name="title" id="title" placeholder="Title">
                                        <span class="small text-danger"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.add_category();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of add category modal -->


                <!-- Update Category Modal -->
                <div class="modal fade" id="update-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Category</h4>
                            </div>
                            <div class="modal-body">
                                <form id="update-category-form">
                                    
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                <button type="button" onclick="_product.update_category();" class="btn btn-default">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update of add category modal -->

            </div>
        </div><!-- Row -->
    </div>