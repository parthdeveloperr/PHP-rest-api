<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend id="legend">data form</legend>
        <form action="" id="myform">
            name:
            <input type="text" name="user_name" id="user_name"><br><br>
            mobile no:
            <input type="text" name="phone" id="phone"><br><br>
            email:
            <input type="email" name="email" id="email"><br><br>
            message:<br>
            <textarea name="message" id="message" cols="30" rows="5"></textarea><br><br>
            <input type="button" name="submit" id="submit" value="submit" class="edit-btn">

        </form>
    </fieldset>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // mail 
        function sendemails() {


            if ($("#myform").valid()) {

                $.ajax({
                    url: "http://localhost/rest_api/sendmail.php",
                    type: "POST",
                    data: {
                        name: '',
                        email: $("#emails").val(),
                        mobileno: '',
                        subject: '',
                        message: ''
                    },
                    success: function(result) {
                        if (result == 'true') {
                            toastr.success('Message sent successfully');

                            document.getElementById("subform").reset();

                        } else {
                            toastr.error('Message not sent');
                        }

                    }
                });
            } else {
                return false;
            }
        }

        $(document).ready(function() {
            $("#submit").on("click", function(e) {
                var name = $("#user_name").val();
                var mob = $("#phone").val();
                var emails = $("#email").val();
                var msg = $("#message").val();

                var data = {
                    "username": "parthdeveloper9@gmail.com",
                    "password": "czlvvrlnpbjecrdf",
                    "setfrom": "parthdeveloper9@gmail.com",
                    "fromname": "testing",
                    "addaddress": "parthdeveloper9@gmail.com",
                    "cc": "",
                    "bcc": "",
                    "subject": "testing",
                    "image": "https://developer.codeingking.com/interior/images/logo.png",
                    user_name: name,
                    phone: mob,
                    email: emails,
                    message: msg
                }
                var myJson2 = JSON.stringify(data);
                $.ajax({
                    url: "http://localhost/rest_api/sendmail.php",
                    type: "POST",
                    data: myJson2,
                    success: function(data) {
                        console.log(data);
                    }
                })

            });
        });
    </script>
</body>

</html>