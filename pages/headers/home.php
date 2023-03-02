<?php
require_once('../../ClassLib/mainlib.php');
$mainPlug = new mainClass();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
  <title>Home Header</title>
  <link href="../../vendors/froala/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../../vendors/froala/froala_editor.pkgd.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />


    	<!-- Notification -->
	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Toastr -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>





  <script src="../../vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>    
  <script>
      tinymce.init({
        selector: '#edit',
        plugins: 'wordcount',
        toolbar: 'wordcount',
        init_instance_callback: function (editor) {
      $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
   }
      });


      tinymce.init({
      selector: '#edit',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak code visualchars wordcount',
      toolbar: 'wordcount',
	  setup: function(editor) {
	  	var max = 200;
	    editor.on('submit', function(event) {
		  var numChars = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
		  if (numChars > max) {
            alert("Only a maximum " + max + " characters are allowed.");
			event.preventDefault();
			return false;
		  }
		});
	  }
   });
 
  //  function codeAddress() {
  //       $(document).ready(function() {
  //       toastr.options.positionClass = 'toast-top-center';
  //       toastr.options.closeButton = true;
  //       toastr.options.progressBar = true;
  //       toastr.options.timeOut = 30000;
  //       toastr.success('Footer Updated', '');
  //   });
  //       }

  </script>
</head>


<?php

if(isset($_POST['submit']) && $_POST['submit'] == 'submit_home_header'){


  $result = $mainPlug->callAPIwImage('addSlider', 'POST', $_POST);
  // var_dump($result);
  // die();
  if(isset($result['status']) && $result['status'] == true){  
    ?>
       <script type='text/javascript'>   
      // var test = >;
      $(document).ready(function() {
      toastr.options.positionClass = 'toast-top-center';
      toastr.options.closeButton = true;
      toastr.options.progressBar = true;
      toastr.options.timeOut = 30000;
      toastr.success('<?php echo $result['message'] ?>', 'Success');
      });

      </script>

  <?php
  // FOR FORMS REPOPULATION 
  unset($_POST);
  }elseif(isset($result['message']) && is_object($result['message'])){
    $message = json_decode(json_encode($result['message']), true);
      // print_r($message);
      // die();

      foreach($message as $key => $error_message)
      {
        ?>
       <script type='text/javascript'>   
       $(document).ready(function() {
       toastr.options.positionClass = 'toast-top-center';
       toastr.options.closeButton = true;
       toastr.options.progressBar = true;
       toastr.options.timeOut = 30000;
       toastr.error('<?php echo $error_message[0] ?>', '<?php echo $key ?>');
       });
 
       </script>
 
        <?php
      }


  }else{
      // var_dump($result);
      // die();

    ?>
       <script type='text/javascript'>   
      // var test = >;
      $(document).ready(function() {
      toastr.options.positionClass = 'toast-top-center';
      toastr.options.closeButton = true;
      toastr.options.progressBar = true;
      toastr.options.timeOut = 30000;
      toastr.error('<?php echo $result ?>', 'Error');
      });

      </script>

  <?php
  }

  // die();



  // <script type='text/javascript'>   
  //       $(document).ready(function() {
  //       toastr.options.positionClass = 'toast-top-center';
  //       toastr.options.closeButton = true;
  //       toastr.options.progressBar = true;
  //       toastr.options.timeOut = 30000;
  //       toastr.success('Footer Updated', 'Success');
  //   });
  //   </script>";
}

?>
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php
      include('../includes/topnav.php');
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <?php
      include('../includes/sidebar.php');
      ?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Default form</h4>
                  <p class="card-description">
                    Basic form layout
                  </p>
                  <form method="POST" action="" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="slider_img" class="file-upload-default" value="<?php echo isset($_POST['slider_img']) ? $_POST['slider_img'] : null; ?>">
                      <div class="input-group col-xs-12">
                        <input type="text" name="slider_img" class="form-control file-upload-info" disabled value="<?php echo isset($_POST['slider_img']) ? $_POST['slider_img'] : null; ?>" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Caption</label>
                      <input type="text" name="caption" class="form-control" id="exampleInputUsername1" value="<?php echo isset($_POST['caption']) ? $_POST['caption'] : null; ?>" placeholder="Caption" maxlength="50">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Description</label>
                      <textarea id='edit' name="desc" style="margin-top: 30px;"  placeholder="Type some text">
                      <?php echo isset($_POST['desc']) ? $_POST['desc'] : null; ?>
                    </textarea>
                    <p class="form-info">For best result, keep description under 600 characters</p>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" id="donate_checkbox" class="form-check-input" onclick="disableDonateBtn()"> 
                              Donate Button
                            </label>
                          </div>
                        </div>
                      </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label">
                              <input type="checkbox" id="video_checkbox" class="form-check-input" onclick="disableVideoLink()">
                            Video Button
                          </label>
                        </div>
                      </div>
                    </div>
                    </div>
                    <?php
                          $causes_result = $mainPlug->homeHeaders('causes-btn');
                          foreach($causes_result->data as $data)
                      ?>

                    <div class="form-group">
                    <label for="exampleFormControlSelect1">Donation Cause</label>
                    <select class="form-control form-control-lg" name="donation_cause" id="donate_btn" disabled>
                    <?php
                    foreach($causes_result->data as $data){
                    ?>
                      <option value="<?php echo $data->id ?>"><?php echo $data->caption ?></option>
                    <?php 
                    }
                    ?>
                    </select>
                  </div>

                  <div class="form-group">
                      <label for="exampleInputUsername1">Youtube URL</label>
                      <input type="text" name="video_link" class="form-control" id="video_link" placeholder="Youtube URL" disabled>
                  </div>

                    <button type="submit" name="submit" value="submit_home_header" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Homepage Slides</h4>
                  <p class="card-description">
                    <!-- Add class <code>.table-hover</code> -->
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Image Link</th>
                          <th>Donate Button</th>
                          <th>Video Button</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $header_result = $mainPlug->homeHeaders('homeHeaders');
                          foreach($header_result->data as $data){
                      ?>
                        <tr id="row<?php echo $data->id; ?>">
                          <td class="py-1">
                            <img src="<?php echo $data->home_slider_img; ?>" alt="image"/>
                          </td>
                          <?php
                          if($data->donation_cause != NULL){
                          ?>
                          <td class="text-success"><i class="mdi mdi-check"></i></td>
                          <?php
                          }else{
                            ?>
                          <td class="text-danger"><i class="mdi mdi-close"></i></td>
                          <?php
                          }
                          ?>

                          <?php
                          if($data->video_link != NULL){
                          ?>
                          <td class="text-success"><i class="mdi mdi-check"></i></td>
                          <?php
                          }else{
                            ?>
                          <td class="text-danger"><i class="mdi mdi-close"></i></td>
                          <?php
                          }
                          ?>


                          <td>
                            <button type="button" onclick="deleteHeader(<?php echo $data->id; ?>)" class="btn btn-inverse-danger btn-icon">
                            <i class="mdi mdi-delete"></i>
                            </button>
                          </td>
                        </tr>

                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
      <!-- FOOTER STARTS HERE  -->
        <?php
        include('../includes/footer.php')
        ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->

  <script>
  function disableDonateBtn() {
  var donate_btn = document.getElementById("donate_checkbox");

  if(donate_btn.checked == true){
  document.getElementById("donate_btn").disabled = false;
  } else {
  document.getElementById("donate_btn").disabled = true;
  }
}


  function disableVideoLink() {
  var video_link = document.getElementById("video_checkbox");

  if(video_link.checked == true){
  document.getElementById("video_link").disabled = false;
  } else {
  document.getElementById("video_link").disabled = true;
  }
  }



function deleteHeader(headerID){
    let text = "Are you sure you want to delete this Header? \n This action can't be undone.";
    if (confirm(text) == true) {
    let apiName = 'deleteHeader';
    document.getElementById("row"+headerID).remove();
    $.get("../../ClassLib/deleteHeader.php", {headerID: headerID, apiName: apiName}, 
    function(){
        toastr.options.positionClass = 'toast-top-center';
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        toastr.options.timeOut = 30000;
        toastr.success('Header Deleted', 'Success');
    });
  }
}

  </script>

</body>

</html>
