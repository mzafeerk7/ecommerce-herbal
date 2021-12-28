<!-- Page Inner -->
<div class="page-inner">
    <!-- <div class="page-title">
        <h3 class="breadcrumb-header">Add Product</h3>
    </div> -->
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?php if(isset($product) && !empty($product)): ?>
                    <div class="panel panel-darkblue" style="margin-top: 2em;">
                        <div class="panel-heading clearfix">
                            <div id="result"></div>
                            <h2 class="panel-title">Update Product</h2>
                        </div>
                        <div class="panel-body basic-form-panel">
                            <form id="update-product-form">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="title">Title</label>
                                        <input type="hidden" name="id" value="<?= encrypt_id($product[0]['p_id']) ?>">
                                        <input type="text" class="form-control error" name="title" id="title" placeholder="Title" value="<?= $product[0]['p_title'] ?>">
                                        <span class="small text-danger"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Price ($) </label>
                                        <input type="number" class="form-control error" name="price" id="price" placeholder="$" value="<?= $product[0]['p_price'] ?>">
                                        <span class="small text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="category">Category </label>
                                        <select class="form-control form-select-options" name="category" id="category" style="padding: 0px !important;">
                                            <?php if(isset($categories) && !empty($categories)): ?>
                                                <?php foreach($categories as $category): ?>
                                                    <?php 
                                                        $attr = '';
                                                        if($category['c_id'] === $product[0]['c_id']){
                                                            $attr = 'selected';
                                                        }
                                                    ?>
                                                    <option value="<?= $category['c_id'] ?>" <?= $attr ?>><?= ucwords($category['c_title']) ?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-grou col-md-6">
                                        <label for="description">Description </label>
                                        <textarea name="description" id="description" class="form-control error" rows="5"><?= $product[0]['p_description'] ?></textarea>
                                        <div class="description error"></div>
                                        <span class="small text-danger"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="additional_info">Additional Info </label>
                                        <textarea name="additional_info" id="additional_info" class="form-control" rows="5"><?= $product[0]['p_additional_information'] ?></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <label  for="exampleInputPassword1">Product Image</label>
                                            <div class="img-box text-center">
                                                <img src="<?= base_url().'assets/img/products/'.$product[0]['p_thumb'] ?>" alt="image" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <label for="exampleInputPassword1">Secondary Image</label>
                                            <div class="img-box text-center">
                                            <img src="<?= base_url().'assets/img/products/'.$product[0]['p_second_thumb'] ?>" alt="image" class="img-fluid mx-auto d-block">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputPassword1">Product Image</label>
                                        <input type="file" name="thumb" id="thumb" class="dropify" data-allowed-file-extensions="jpg png gif jpeg">
                                        <div class="thumb error"></div>
                                        <span class="small text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputPassword1">Secondary Image</label>
                                        <input type="file" name="second_thumb" id="second_thumb" class="dropify" data-allowed-file-extensions="jpg png gif jpeg">
                                        <div class="second_thumb error"></div>
                                        <span class="small text-danger"></span>
                                    </div>
                                </div>
                                <button type="button" onclick="_product.update_product();" class="btn  btn-default btn-lg m-b-xxs pull-right">Save</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                <div class="panel panel-darkblue" style="margin-top: 2em;">
                    <div class="panel-body basic-form-panel">
                        <h2 class="panel-title">Data not found!</h2>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div><!-- Row -->
    </div><!-- Main Wrapper -->