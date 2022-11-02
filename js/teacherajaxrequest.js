// Ajax Call for teacher Login Verification
function checkTeacherLogin() {
    var teacherLogEmail = $("#teacherLogEmail").val();
    var teacherLogPass = $("#teacherLogPass").val();
    $.ajax({
      url: "teacher/teacher.php",
      type: "post",
      data: {
        checkLogemail: "checklogmail",
       teacherLogEmail:teacherLogEmail,
       teacherLogPass:teacherLogPass,
      },
      success: function(data) {
        console.log(data);
        if (data == 0) {
          $("#statusTeacherLogMsg").html(
            '<small class="alert alert-danger"> Invalid Email ID or Password ! </small>'
          );
        } else if (data == 1) {
          $("#statusTeacherLogMsg").html(
            '<small class="alert alert-success"> Success! Loading..... </small>'
          );
          // Empty Login Fields
          clearTeacherLoginField();
          setTimeout(() => {
            window.location.href = "teacher/teacherProfile.php";
          }, 1000);
        }
      }
    });
  }
  
  // Empty Login Fields
  function clearTeacherLoginField() {
    $("#teacherLoginForm").trigger("reset");
  }
  
  // Empty Login Fields and Status Msg
  function clearTeacherLoginWithStatus() {
    $("#statusTeacherLogMsg").html(" ");
    clearTeacherLoginField();
  }
  