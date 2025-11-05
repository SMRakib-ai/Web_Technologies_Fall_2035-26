<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Donation Form</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { color: darkred; }
    form { max-width: 600px; }
    label { display: block; margin-top: 10px; font-weight: bold; }
    input[type="text"], input[type="email"], select, textarea {
      width: 100%;
      padding: 6px;
      margin-top: 4px;
      box-sizing: border-box;
    }
    input[type="radio"], input[type="checkbox"] { margin-right: 6px; }
    .section { margin-top: 20px; border-top: 2px solid #ccc; padding-top: 15px; }
    .button-row { margin-top: 20px; }
  </style>
</head>
<body>

  <h2>Donor Information</h2>
  <form action="#" method="post">
    <label>First Name* <input type="text" name="first_name" required></label>
    <label>Last Name* <input type="text" name="last_name" required></label>
    <label>Company <input type="text" name="company"></label>
    <label>Address 1* <input type="text" name="address1" required></label>
    <label>Address 2 <input type="text" name="address2"></label>
    <label>City* <input type="text" name="city" required></label>
    <label>State*
      <select name="state" required>
        <option value="">Select a State</option>
        <option>CA</option>
        <option>NY</option>
        <option>TX</option>
      </select>
    </label>
    <label>Zip Code* <input type="text" name="zip" required></label>
    <label>Country*
      <select name="country" required>
        <option value="">Select a Country</option>
        <option>United States</option>
        <option>Canada</option>
        <option>Other</option>
      </select>
    </label>
    <label>Phone <input type="text" name="phone"></label>
    <label>Fax <input type="text" name="fax"></label>
    <label>Email* <input type="email" name="email" required></label>

    <p><strong>Donation Amount*</strong></p>
    <label><input type="radio" name="amount" value="50"> $50</label>
    <label><input type="radio" name="amount" value="75"> $75</label>
    <label><input type="radio" name="amount" value="100"> $100</label>
    <label><input type="radio" name="amount" value="250"> $250</label>
    <label><input type="radio" name="amount" value="other"> Other: $
      <input type="text" name="other_amount" size="6">
    </label>

    <label><input type="checkbox" name="recurring"> I am interested in giving on a regular basis.</label>
    <label>Monthly Credit Card $
      <input type="text" name="monthly_amount" size="6"> for
      <input type="text" name="months" size="3"> months
    </label>

    <div class="section">
      <h2>Honorarium and Memorial Donation Information</h2>
      <label><input type="radio" name="tribute" value="honor"> To Honor</label>
      <label><input type="radio" name="tribute" value="memory"> In Memory of</label>
      <label>Name <input type="text" name="tribute_name"></label>
      <label>Acknowledge Donation to
        <input type="text" name="ack_name">
      </label>
      <label>Address <input type="text" name="ack_address"></label>
      <label>City <input type="text" name="ack_city"></label>
      <label>State
        <select name="ack_state">
          <option value="">Select a State</option>
        </select>
      </label>
      <label>Zip <input type="text" name="ack_zip"></label>
    </div>

    <div class="section">
      <h2>Additional Information</h2>
      <p>Please enter your name, company, or organization as you would like it to appear in our publications:</p>
      <label><input type="checkbox" name="anonymous"> I would like my gift to remain anonymous.</label>
      <label><input type="checkbox" name="matching"> My employer offers a matching gift program.</label>
      <label><input type="checkbox" name="no_thankyou"> Please save the cost of acknowledging this gift by not mailing a thank you letter.</label>
      <label>Comments / Feedback<textarea name="comments" rows="4"></textarea></label>

      <p><strong>How may we contact you?</strong></p>
      <label><input type="checkbox" name="contact_email"> E-mail</label>
      <label><input type="checkbox" name="contact_post"> Postal Mail</label>
      <label><input type="checkbox" name="contact_phone"> Telephone</label>
      <label><input type="checkbox" name="contact_fax"> Fax</label>

      <label>I would like to receive newsletters and information about special events by:
        <label><input type="checkbox" name="newsletter_email"> E-mail</label>
        <label><input type="checkbox" name="newsletter_post"> Postal Mail</label>
      </label>

      <label><input type="checkbox" name="volunteering"> I would like information about volunteering with the organization.</label>
    </div>

    <div class="button-row">
      <input type="reset" value="Reset">
      <input type="submit" value="Continue">
    </div>

    <p><small>Donate online with confidence. You are on a secure server.</small></p>
  </form>

</body>
</html>