<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <p id="error" style="color:red"></p>
    <form id="form" name="form" method="post">
        <label for="full_name">Full name</label>
        <input type="text" name="full_name" id="full_name">
        <br>
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <br>
        <br>
        <label for="number">Mobile Number</label>
        <input type="text" name="number" id="number">
        <br>
        <br>
        <label for="birthday">Date of birth</label>
        <input type="date" id="birthday" name="birthday" onchange="calculateAge()">
        <br>
        <br>
        <label for="age">Age</label>
        <input type="text" name="age" id="age" readonly>
        <br>
        <br>
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="male" selected>male</option>
            <option value="female">female</option>
        </select>

        <br>
        <br>
        <input type="button" name="save" value="Save" id="save">

    </form>
</body>
<script>
    function calculateAge() {
      let userInput = document.getElementById("birthday").value

      if(userInput == null || userInput== '') {
        document.getElementById("age").innerHTML.value = " ";

      } else {
        let birthday = new Date(userInput)
        let currentDate = new Date()
        let gap = currentDate - birthday
        const age = Math.floor(gap / 31557600000)

        document.getElementById("age").value = age;
      }
    }

    $(document).ready(function() {
      $('#save').on('click', function() {
        $('#error').empty()
        let name = $('#full_name').val();
        let email = $('#email').val();
        let number = $('#number').val();
        let birthday = $('#birthday').val();
        let age = $('#age').val();
        let gender = $('#gender').find(":selected").text();
        if(name != "" && email!= "" && number != "" && birthday!= "" &&
          age != "" && gender != ""){
          $.ajax({
            url: "save.php",
            type: "POST",
            data: {
              name: name,
              email: email,
              number: number,
              birthday: birthday,
              age: age,
              gender: gender
            },
            cache: false,
            success: function(dataResult){
              let result = JSON.parse(dataResult);
              if(result.status_code === 422){
                $("#error").append(result.error)
              }
              else if(result.status_code === 200){
                $('#form').find('input:text').val('');
                alert("record added successfully");
              }
            }
          });
        }
        else{
          $("#error").append("All fields are required")
        }
      });
    });


</script>
</html>