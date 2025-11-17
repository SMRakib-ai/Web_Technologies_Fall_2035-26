<!DOCTYPE html>
<html>
<head>
<title>Product Review System</title>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f5f5;
        }
 
        .container {
            width: 700px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
 
        h2 {
            text-align: center;
            color: #333;
        }
 
        label {
            font-weight: bold;
        }
 
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 6px 0 15px 0;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
 
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
 
        /* Stars */
        .stars span {
            font-size: 30px;
            cursor: pointer;
            color: #bbb;
        }
 
        .stars .active {
            color: orange;
        }
 
        .review-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            background: #fafafa;
        }
 
        .stats {
            background: #e8f4ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
 
        .help-btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
 
        .sort-box {
            float: right;
        }
</style>
</head>
<body>
 
<div class="container">
<h2>Product Review System</h2>
 
    <!-- Statistics -->
<div class="stats">
<p><b>Total Reviews:</b> <span id="totalReviews">0</span></p>
<p><b>Average Rating:</b> <span id="avgRating">0</span></p>
<p><b>Recommendation %:</b> <span id="recPercent">0%</span></p>
</div>
 
    <!-- Sorting -->
<select id="sortOption" class="sort-box" onchange="renderReviews()">
<option value="newest">Newest First</option>
<option value="highest">Highest Rated First</option>
</select>
 
    <br><br>
 
    <!-- Review Form -->
<h3>Write a Review</h3>
 
    <form id="reviewForm">
<label>Customer Name *</label>
<input type="text" id="name">
<div id="nameError" class="error"></div>
 
        <label>Email (Optional)</label>
<input type="text" id="email">
<div id="emailError" class="error"></div>
 
        <label>Review Title *</label>
<input type="text" id="title">
<div id="titleError" class="error"></div>
 
        <label>Review Description *</label>
<textarea id="desc" rows="4"></textarea>
<small id="charCount">0 / 1000</small>
<div id="descError" class="error"></div>
 
        <label>Rating *</label>
<div class="stars" id="starBox">
<span onclick="setRating(1)">★</span>
<span onclick="setRating(2)">★</span>
<span onclick="setRating(3)">★</span>
<span onclick="setRating(4)">★</span>
<span onclick="setRating(5)">★</span>
</div>
<div id="ratingError" class="error"></div>
 
        <label>Would Recommend?</label><br>
<input type="radio" name="rec" value="yes"> Yes
<input type="radio" name="rec" value="no"> No
 
        <br><br>
 
        <button type="button" onclick="submitReview()">Submit Review</button>
</form>
 
    <hr>
 
    <h3>All Reviews</h3>
<div id="reviewsList"></div>
 
</div>
 
 
<script>
let reviews = [];
let selectedRating = 0;
 
// Character counter
document.getElementById("desc").addEventListener("input", function() {
    document.getElementById("charCount").innerText = this.value.length + " / 1000";
});
 
// Star rating
function setRating(num) {
    selectedRating = num;
    let stars = document.querySelectorAll("#starBox span");
    stars.forEach((s, i) => {
        s.classList.toggle("active", i < num);
    });
}
 
// Validation helper
function showError(id, msg) {
    document.getElementById(id).innerHTML = msg;
}
 
// Submit review
function submitReview() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let title = document.getElementById("title").value.trim();
    let desc = document.getElementById("desc").value.trim();
    let rec = document.querySelector("input[name='rec']:checked");
 
    let valid = true;
 
    // Name
    if (name.length < 2 || name.length > 30) {
        showError("nameError", "Name should be between 2 and 30 characters");
        valid = false;
    } else showError("nameError", "");
 
    // Email
    if (email !== "" && !email.match(/^[^@]+@\w+\.\w+$/)) {
        showError("emailError", "Please enter a valid email address");
        valid = false;
    } else showError("emailError", "");
 
    // Title
    if (title.length < 5 || title.length > 100) {
        showError("titleError", "Review title should be between 5 and 100 characters");
        valid = false;
    } else showError("titleError", "");
 
    // Description
    if (desc.length < 20 || desc.length > 1000) {
        showError("descError", "Review description should be between 20 and 1000 characters");
        valid = false;
    } else showError("descError", "");
 
    // Rating
    if (selectedRating === 0) {
        showError("ratingError", "Please select a product rating");
        valid = false;
    } else showError("ratingError", "");
 
    if (!valid) return;
 
    reviews.push({
        name,
        email,
        title,
        desc,
        rating: selectedRating,
        rec: rec ? rec.value : "no",
        date: new Date(),
        helpful: 0
    });
 
    renderReviews();
    updateStats();
    document.getElementById("reviewForm").reset();
    setRating(0);
}
 
// Update statistics
function updateStats() {
    document.getElementById("totalReviews").innerText = reviews.length;
 
    if (reviews.length === 0) return;
 
    let avg = reviews.reduce((a, r) => a + r.rating, 0) / reviews.length;
    document.getElementById("avgRating").innerText = avg.toFixed(1);
 
    let recCount = reviews.filter(r => r.rec === "yes").length;
    let percent = (recCount / reviews.length) * 100;
    document.getElementById("recPercent").innerText = percent.toFixed(0) + "%";
}
 
// Display reviews
function renderReviews() {
    let list = document.getElementById("reviewsList");
    list.innerHTML = "";
 
    let sorted = [...reviews];
 
    let sortType = document.getElementById("sortOption").value;
    if (sortType === "highest") {
        sorted.sort((a, b) => b.rating - a.rating);
    } else {
        sorted.sort((a, b) => b.date - a.date);
    }
 
    sorted.forEach((r, index) => {
        let box = document.createElement("div");
        box.className = "review-box";
 
        box.innerHTML = `
<h4>${r.title}</h4>
<p><b>${r.name}</b> | Rating: ${"★".repeat(r.rating)}</p>
<p>${r.desc}</p>
<p><i>${r.date.toLocaleString()}</i></p>
<button class="help-btn" onclick="markHelpful(${index})">
                Helpful (${r.helpful})
</button>
        `;
 
        list.appendChild(box);
    });
}
 
// Helpful button
function markHelpful(i) {
    reviews[i].helpful++;
    renderReviews();
}
</script>
 
</body>
</html>