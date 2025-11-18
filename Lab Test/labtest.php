<!DOCTYPE html>
<html lang="en">
    <head>
<meta carset = "UTF-8">
<title> Lab Exam </title>
<style>
     body {
          background: gray;
          padding: 20px;
 }
 .container {
          width: 450px;
          background: white;
          padding: 20px;
          border-radius: 8px;
          }
          input, button {
            width: 100%;
            padding: 10px;
            margin: 7px ;

        }
    </style>
</head>

    <html>
        <body allign=center>

<body>
 
<div class="container">
<h2>Event Registration</h2>
 
    <form id="regForm">

<label>Full Name</label>
<input type="text" id="fullname">
<p class="error" id="nameError"></p>
 
        
<label>Professional Email</label>
<input type="text" id="email">
<p class="error" id="emailError"></p>
 
        
<label>Company / Institution (Optional)</label>
<input type="text" id="company">
 

<label>Attendance Type</label><br>
<input type="radio" name="attend" value="Virtual"> Virtual  
<input type="radio" name="attend" value="In-Person"> In-Person
<p class="error" id="attendError"></p>
 
        <button type="button" onclick="submitForm()">Register</button>
</form>
 
    <button id="toggleAnalyticsBtn" onclick="toggleAnalytics()">Show Event Analytics</button>
 
    
<div id="analyticsPanel">
<h3>Event Analytics</h3>
<p>Total Registrants: <span id="totalCount">0</span></p>
<p>Virtual: <span id="virtualCount">0</span></p>
<p>In-Person: <span id="inpersonCount">0</span></p>
</div>
</div>
<script>
     let registrations = [];
 
    function submitForm() {
        let fullname = document.getElementById("fullname").value.trim();
        let email = document.getElementById("email").value.trim();
        let company = document.getElementById("company").value.trim();
        let attendance = document.querySelector('input[name="attend"]:checked');
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";
        document.getElementById("attendError").innerHTML = "";
 
        let isValid = true;

        if (fullname.length < 6 || fullname.length > 100) {
            document.getElementById("nameError").innerHTML = "Name must be between 6 and 100 characters.";

            isValid = false;

        }
 
         if (!email.includes("@") || !email.includes(".")) {

            document.getElementById("emailError").innerHTML =  "Please enter a valid professional email address.";

            isValid = false;

        }
         if (!attendance) {
            document.getElementById("attendError").innerHTML ="Please select your attendance type.";
            isValid = false;

        }
 
        if (!isValid) return;
            registrations.push({
            name: fullname,
            email: email,
            company: company,
            attend: attendance.value

        });
 
        alert("Registration Successful!");
     document.getElementById("regForm").reset();
      updateAnalytics();

    }
 
     function updateAnalytics() {

        let total = registrations.length;
        let virtual = registrations.filter(r => r.attend === "Virtual").length;
        let inperson = registrations.filter(r => r.attend === "In-Person").length;
        document.getElementById("totalCount").innerHTML = total;
        document.getElementById("virtualCount").innerHTML = virtual;
        document.getElementById("inpersonCount").innerHTML = inperson;

    }
 
     function toggleAnalytics() {
        let panel = document.getElementById("analyticsPanel");
        let btn = document.getElementById("toggleAnalyticsBtn");
        if (panel.style.display === "none") {
            panel.style.display = "block";
            btn.innerHTML = "Hide Event Analytics";
     } else {
        panel.style.display = "none";
        btn.innerHTML = "Show Event Analytics";

        }

    }
     



</script>
     






</body>





    </html>