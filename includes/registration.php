<?php
//error_reporting(0);
if(isset($_POST['signup']))
{
    $fname = $_POST['fullname'];
    $email = $_POST['emailid'];
    $mobile = $_POST['mobileno'];
    $password = md5($_POST['password']);
    $area = $_POST['area']; // New field for area

    $sql = "INSERT INTO users(FullName, EmailId, ContactNo, Password, area) VALUES(:fname, :email, :mobile, :password, :area)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':area', $area, PDO::PARAM_STR); // Bind the area parameter
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo "<script>alert('Registration successful. Now you can login');</script>";
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>

<script>
function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#emailid").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
</script>

<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post" name="signup">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                  <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <label for="area">Select Area:</label>
                  <select class="form-control" name="area" required>
                    <option value="Notun Bazar">Notun Bazar</option>
                    <option value="Baridhara">Baridhara</option>
                    <option value="Bashundhara R/A">Bashundhara R/A</option>
                    <option value="Badda">Badda</option>
                    <option value="Rampura">Rampura</option>
                    <option value="Mohakhali">Mohakhali</option>
                    <option value="Gulshan">Gulshan</option>
                    <option value="Banani">Banani</option>
                    <option value="Dhanmondi">Dhanmondi</option>
                    <option value="Mirpur">Mirpur</option>

                  </select>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>
