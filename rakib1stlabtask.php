
<html>

<head>
    <title>Donation Form</title>
    <style>
        body {
            margin-left: 20%;
            margin-right: 20%;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background-color: lightgrey;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        .right-align {
            text-align: right;
            font-weight: bold;
            padding-right: 10px;
        }

        #header1 {
            font-size: small;
        }

        #header2 {
            font-weight: bold;
        }

        input,
        select,
        textarea {
            padding: 5px;
            width: 250px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            width: 300px;
            height: 60px;
        }

        .section-title {
            color: red;
            font-weight: bold;
            padding-top: 20px;
        }

        .button-container {
            text-align: center;
            padding-top: 20px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #555;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #333;
        }

        .note {
            font-size: small;
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        .small-text {
            font-size: small;
        }
    </style>
</head>

<body>
    <div class="container">
        <p id="header1"><span style="color:red">*</span> - Denotes Required Information</p>
        <p><span id="header2">> 1 Donation</span> > 2 Confirmation > 3 Thank You!</p>

        <form>
            <table>
                <!-- Donor Information -->
                <tr>
                    <td colspan="2" class="section-title">Donor Information</td>
                </tr>

                <tr>
                    <td class="right-align">First Name <span style="color:red">*</span></td>
                    <td><input type="text" placeholder="Enter first name"></td>
                </tr>

                <tr>
                    <td class="right-align">Last Name <span style="color:red">*</span></td>
                    <td><input type="text" placeholder="Enter last name"></td>
                </tr>

                <tr>
                    <td class="right-align">Company</td>
                    <td><input type="text" placeholder="Enter company name"></td>
                </tr>

                <tr>
                    <td class="right-align">Address 1 <span style="color:red">*</span></td>
                    <td><input type="text" placeholder="Enter address line 1"></td>
                </tr>

                <tr>
                    <td class="right-align">Address 2</td>
                    <td><input type="text" placeholder="Enter address line 2"></td>
                </tr>

                <tr>
                    <td class="right-align">City <span style="color:red">*</span></td>
                    <td><input type="text" placeholder="Enter city"></td>
                </tr>

                <tr>
                    <td class="right-align">State</td>
                    <td>
                        <select>
                            <option selected disabled>Select a State</option>
                            <option>New York</option>
                            <option>California</option>
                            <option>Texas</option>
                            <option>Florida</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="right-align">Zip Code</td>
                    <td><input type="text" placeholder="Enter zip code"></td>
                </tr>

                <tr>
                    <td class="right-align">Country</td>
                    <td>
                        <select>
                            <option selected disabled>Select a Country</option>
                            <option>Bangladesh</option>
                            <option>USA</option>
                            <option>UK</option>
                            <option>India</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="right-align">Phone</td>
                    <td><input type="text" placeholder="Enter phone number"></td>
                </tr>

                <tr>
                    <td class="right-align">Fax</td>
                    <td><input type="text" placeholder="Enter fax number"></td>
                </tr>

                <tr>
                    <td class="right-align">Email <span style="color:red">*</span></td>
                    <td><input type="email" placeholder="Enter email address"></td>
                </tr>

                <tr>
                    <td class="right-align">Donation Amount <span style="color:red">*</span></td>
                    <td>
                        <input type="radio" name="amount">$50
                        <input type="radio" name="amount">$75
                        <input type="radio" name="amount">$100
                        <input type="radio" name="amount">$250
                        <input type="radio" name="amount">Other
                        <input type="text" placeholder="$" style="width:80px;">
                    </td>
                </tr>

                <tr>
                    <td class="right-align">Recurring Donation</td>
                    <td>
                        <input type="checkbox"> I am interested in giving on a regular basis.<br>
                        Monthly Credit Card $
                        <input type="text" style="width:60px;"> for
                        <input type="text" style="width:40px;"> months.
                    </td>
                </tr>

                <!-- Honorarium Section -->
                <tr>
                    <td colspan="2" class="section-title">Honorarium and Memorial Donation Information</td>
                </tr>
                <tr>
                    <td class="right-align">I would like to make this donation</td>
                    <td>
                        <input type="radio" name="honor"> To Honor
                        <input type="radio" name="honor"> In Memory Of
                    </td>
                </tr>
                <tr>
                    <td class="right-align">Name</td>
                    <td><input type="text" placeholder="Enter name"></td>
                </tr>
                <tr>
                    <td class="right-align">Acknowledge Donation To</td>
                    <td><input type="text" placeholder="Enter name"></td>
                </tr>
                <tr>
                    <td class="right-align">Address</td>
                    <td><input type="text" placeholder="Enter address"></td>
                </tr>
                <tr>
                    <td class="right-align">City</td>
                    <td><input type="text" placeholder="Enter city"></td>
                </tr>
                <tr>
                    <td class="right-align">State</td>
                    <td>
                        <select>
                            <option>Select a State</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="right-align">Zip</td>
                    <td><input type="text" placeholder="Enter zip"></td>
                </tr>

                <!-- Additional Info -->
                <tr>
                    <td colspan="2" class="section-title">Additional Information</td>
                </tr>
                <tr>
                    <td colspan="2" class="small-text">
                        Please enter your name, company, or organization as you would like it to appear in our publications:
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox"> I would like my gift to remain anonymous. <br>
                        <input type="checkbox"> My employer offers a matching gift program. <br>
                        <input type="checkbox"> Please save the cost of acknowledging this gift by not mailing a thank-you letter.
                    </td>
                </tr>

                <tr>
                    <td class="right-align">Comments</td>
                    <td><textarea placeholder="Enter any questions or feedback"></textarea></td>
                </tr>

                <tr>
                    <td class="right-align">How may we contact you?</td>
                    <td>
                        <input type="checkbox"> E-mail
                        <input type="checkbox"> Postal Mail
                        <input type="checkbox"> Telephone
                        <input type="checkbox"> Fax
                    </td>
                </tr>

                <tr>
                    <td class="right-align">I would like to receive newsletters and updates by:</td>
                    <td>
                        <input type="checkbox"> E-mail
                        <input type="checkbox"> Postal Mail
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="button-container">
                        <input type="reset" value="Reset">
                        <input type="submit" value="Continue">
                    </td>
                </tr>
            </table>
        </form>

        <p class="note">Donate online with confidence. You are on a secure server.<br>
            If you have any problems or questions, please contact support.</p>
    </div>
</body>

</html>