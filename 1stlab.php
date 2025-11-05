<html>

<head>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: lightgrey;
        }

        body {
            margin-left: 20%;
            margin-right: 20%;
        }

        table {
            margin-left: auto;
            margin-right: auto;

        }

        .center-text {
            text-align: center;
        }

        .right-alignment {
            text-align: right;
            font-weight: bold;
        }

        #header1 {
            font-size: small;
        }

        #header2 {
            font-weight: bold;
        }

        .sm {
            font-size: 10px;
        }

        .amount-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .amount-container label {
            margin: 0;
            white-space: nowrap;
        }

        .amount-container input {
            width: 100px;
        }
    </style>

    <script>
        console.log("Hello world from js console");
        var abc = "Education";
        console.log("The value of abc is ..", abc);
        var abc;
        console.log("The value of abc is still..", abc);

        var first_name = "";
        function validateForm() {
            first_name = document.getElementById("first_name").value;
            console.log("first name is...", first_name);
            var line = "Hello " + first_name;
            alert(line);
        }

    </script>
</head>

<body>

    <div class="container">

        <form action="" onsubmit="validateForm()" method="get">
            <table>
                <tr>
                    <td class="left-alignment">Full Name <span style="color:red"></span></td>
                   
                </tr>

                <tr>
                     <td><input type="text"  id="first_name" /></td>
                </tr>
                <tr>
                    <td class="left-alignment">Email<span style="color:red"></span></td>
                </tr>
                <tr>
                     <td><input type="text"  id="Email" /></td>
                </tr>
                <tr>
                    <td class="left-alignment">Password <span style="color:red"></span></td>
                </tr>
                <tr>
                     <td><input type="text"  id="first_name" /></td>
                </tr>
                
                <tr>
                    <td class="left-alignment">Role</td>
                    <tr>
                        <tr>
                    <td>
                        <input type="radio" name="Admin" value="Admin" />Admin
                        <input type="radio" name="User" value="User" />User
                    </td>
                </tr>
                <tr>
                <td class="left alignment">Already have an account? <a href="1stlab2.php">Sign in</a></td>
                </tr>
                
                <tr>
                    <td>

                        <button type="submit">Submit</button>
                    </td>
                </tr>

            </table>
        </form>
    </div>

</body>

</html>