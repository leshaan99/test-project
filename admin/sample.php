<?php
include_once './header.php';

// Form Configuration
$form_config = [
    'heading' => 'Products',
    'form_action' => 'data/register_product.php',
    'inputs' => [
        'id' => ['type' => 'hidden', 'value' => ''],
        'f1' => ['label' => 'Title', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f2' => ['label' => 'Sub Title 1', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f3' => ['label' => 'Content 1', 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f4' => ['label' => 'Sub Title 2', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f5' => ['label' => 'Content 2' , 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f6' => ['label' => 'Sub Title 3', 'type' => 'text', 'class' => 'form-control', 'div_class' => 'col-lg-12 col-md-12 form-group'],
        'f7' => ['label' => 'Content 3' , 'type' => 'textarea', 'class' => 'form-control summernote', 'div_class' => 'col-lg-12 col-md-12 form-group'],
    ],
];




// Fetch product data if an ID is provided
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : 0;
$row = $id > 0 ? $product->get_by_id($id)['data'] : null;

include_once './navbar.php';
include_once './sidebar.php';
?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Page Header -->
    <?php
    $heading = $form_config['heading'];
    $page_title = $id > 0 ? "Update $heading" : "New $heading";
    include_once './page_header.php';
    ?>
    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                        <form action="<?= $form_config['form_action'] ?>" method="post" enctype="multipart/form-data">
                              <div class="hidden">
                         
                              <?php if ($id==0){
                                echo '<input type="hidden" name="created_by" value="'.$user_act.'" />';
                              }else{
                                echo '<input type="hidden" name="updated_by" value="'.$user_act.'" />';
                              }


                              ?>


                              </div>

                                <div class="row">
                                    <!-- Image 1 -->
                                    <div class="col-lg-4 col-md-4 form-group">
                                        <label for="img1">Upload Image 1:</label>
                                        <div class="mb-2" id="preview_img1" >
                                        <?php  if ( isset( $row['img1']) && $row['img1'] != '') { ?>
                                            <img src="../<?= $row['img1']; ?>" class="img-thumbnail" style="max-width: 150px;" />
                                       
                                       <?php } else { ?>

                                        <img src="./assets/img/photo1.png" class="img-thumbnail" style="max-width: 150px;" />

                                        <?php }?>
                                       
                                        </div>

                                        <input type="file" name="img1" id="img1" class="form-control" accept="image/*" />
                                        
                                    </div>
                                    <!-- Image 2 -->

                                    <div class="col-lg-4 col-md-4 form-group">
                                        <label for="img2">Upload Image 1:</label>
                                        <div class="mb-2" id="preview_img2" >
                                        <?php  if ( isset( $row['img2']) && $row['img2'] != '') { ?>
                                            <img src="../<?= $row['img2']; ?>" class="img-thumbnail" style="max-width: 150px;" />
                                       
                                       <?php } else { ?>

                                        <img src="./assets/img/photo1.png" class="img-thumbnail" style="max-width: 150px;" />

                                        <?php }?>
                                       
                                        </div>

                                        <input type="file" name="img2" id="img2" class="form-control" accept="image/*" />
                                        
                                    </div>
                   
                                    <!-- Image 3 -->

                                    <div class="col-lg-4 col-md-4 form-group">
                                        <label for="img3">Upload Image 1:</label>
                                        <div class="mb-2" id="preview_img3" >
                                        <?php  if ( isset( $row['img3']) && $row['img3'] != '') { ?>
                                            <img src="../<?= $row['img3']; ?>" class="img-thumbnail" style="max-width: 150px;" />
                                       
                                       <?php } else { ?>

                                        <img src="./assets/img/photo1.png" class="img-thumbnail" style="max-width: 150px;" />

                                        <?php }?>
                                       
                                        </div>

                                        <input type="file" name="img3" id="img3" class="form-control" accept="image/*" />
                                        
                                    </div>
                           
                                </div>

                                <?php include_once '../inc/input_generate.php'; ?>

                                <hr>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 form-group">
                                        <button type="submit" class="btn btn-block btn-outline-<?= $id > 0 ? 'success' : 'secondary' ?>">
                                            <?= $id > 0 ? 'Update Now' : 'Add New' ?>
                                        </button>
                                    </div>
                                    <div class="col-lg-2 col-md-2 form-group">
                                        <button type="reset" class="btn btn-block btn-outline-warning">Reset</button>
                                    </div>
                                </div>
                            </form>
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
</div>
</section>
</div>
<?php include_once './footer.php'; ?>

<script>   

previewImage('img1', 'preview_img1');
previewImage('img2', 'preview_img2');
previewImage('img3', 'preview_img3');
</script>


<script>

    
function previewImage(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId).querySelector('img');
    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
}

</script>

</body>

</html>