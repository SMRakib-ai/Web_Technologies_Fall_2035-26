<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Comment System (Lab)</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
    :root{
      --max-width:900px;
      --accent:#2b6cb0;
      --muted:#666;
      --card-bg:#fff;
      --bg:#f5f7fb;
    }
    body{
      font-family: Inter, Roboto, Arial, sans-serif;
      background: var(--bg);
      margin: 0;
      padding: 24px;
      display:flex;
      justify-content:center;
    }
    .container{
      width:100%;
      max-width:var(--max-width);
      background: linear-gradient(#fff, #fff);
      padding:20px;
      border-radius:8px;
      box-shadow: 0 6px 18px rgba(20,30,50,0.08);
    }
    h1{ margin:0 0 12px 0; font-size:20px; }
    .stats{
      display:flex;
      gap:20px;
      align-items:baseline;
      margin-bottom:18px;
    }
    .stat {
      background:#f0f6ff;
      padding:12px 16px;
      border-radius:8px;
      font-weight:600;
      color:var(--accent);
      min-width:160px;
      text-align:center;
    }
    .stat small{ display:block; font-weight:400; color:var(--muted); font-size:13px; margin-top:4px;}
    form{
      background:var(--card-bg);
      padding:16px;
      border-radius:8px;
      box-shadow: 0 2px 8px rgba(16,24,40,0.04);
      margin-bottom:18px;
    }
    .row{ display:flex; gap:12px; }
    .field{
      display:flex;
      flex-direction:column;
      margin-bottom:12px;
      flex:1;
    }
    label{ font-size:14px; margin-bottom:6px; color:#111827; }
    input[type="text"], input[type="email"], textarea{
      padding:10px;
      border:1px solid #d1d5db;
      border-radius:6px;
      font-size:14px;
      outline:none;
    }
    textarea{ min-height:100px; resize:vertical; }
    .error{ color:#b91c1c; font-size:13px; margin-top:6px; }
    .controls{ display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap; }
    .btn{
      background:var(--accent);
      color:white;
      padding:10px 14px;
      border-radius:8px;
      border:0;
      cursor:pointer;
      font-weight:600;
    }
    .star-rating{
      display:flex;
      gap:6px;
      align-items:center;
    }
    .star{
      font-size:20px;
      cursor:pointer;
      user-select:none;
    }
    .star.active{ color: #f59e0b; } /* amber for selected */
    .comments-list{ margin-top:18px; }
    .comment{
      background:#fff;
      padding:12px;
      border-radius:8px;
      margin-bottom:10px;
      border:1px solid #eef2f7;
    }
    .comment-header{ display:flex; justify-content:space-between; gap:12px; align-items:center; margin-bottom:8px; }
    .comment-name{ font-weight:700; }
    .comment-email{ color:var(--muted); font-size:13px; }
    .comment-body{ white-space:pre-wrap; color:#111827; }
    .small-muted{ font-size:13px; color:var(--muted); }
    .rating-chip{
      background: #fffbeb;
      color:#92400e;
      padding:2px 8px;
      border-radius:999px;
      font-weight:700;
      font-size:13px;
    }
    @media (max-width:640px){
      .row{ flex-direction:column; }
      .stats{ flex-direction:column; align-items:flex-start; gap:8px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Article — Comments</h1>

    <!-- Dynamic Statistics Display -->
    <div class="stats" aria-live="polite">
      <div class="stat" id="totalComments">0
        <small>Total Number of Comments</small>
      </div>
      <div class="stat" id="averageRating">— 
        <small>Average Rating (based on rated comments)</small>
      </div>
    </div>

    <!-- Comment Form -->
    <form id="commentForm" novalidate>
      <div class="row">
        <div class="field">
          <label for="name">Name <span class="small-muted">(required)</span></label>
          <input id="name" name="name" type="text" placeholder="Your name" required />
          <div class="error" id="nameError" aria-live="assertive"></div>
        </div>
        <div class="field">
          <label for="email">Email <span class="small-muted">(optional)</span></label>
          <input id="email" name="email" type="email" placeholder="name@example.com" />
          <div class="error" id="emailError" aria-live="assertive"></div>
        </div>
      </div>

      <div class="field">
        <label for="comment">Comment <span class="small-muted">(required)</span></label>
        <textarea id="comment" name="comment" placeholder="Write your comment..."></textarea>
        <div class="error" id="commentError" aria-live="assertive"></div>
      </div>

      <div class="controls">
        <div style="display:flex;gap:12px;align-items:center;">
          <label style="margin:0 6px 0 0;">Content Rating (optional)</label>
          <div class="star-rating" id="starRating" role="radiogroup" aria-label="Star rating (1 to 5)">
            <!-- stars inserted by JS -->
          </div>
          <div id="selectedRating" class="small-muted" aria-live="polite" style="margin-left:6px;">Not rated</div>
        </div>

        <div style="display:flex;gap:10px;align-items:center;">
          <button type="submit" class="btn">Submit Comment</button>
          <button type="button" id="clearAll" style="background:#ef4444;color:white;padding:8px 12px;border-radius:8px;border:0;cursor:pointer;">Clear All (session)</button>
        </div>
      </div>
    </form>

    <!-- Comments List -->
    <div class="comments-list" id="commentsList" aria-live="polite">
      <!-- comments rendered here -->
      <p class="small-muted" id="noComments">No comments yet. Be the first!</p>
    </div>
  </div>

  <script>
    // In-session storage of comments (no DB or localStorage).
    // Each comment: { name, email, comment, rating (1-5 or null), timestamp }
    const comments = [];

    // DOM refs
    const totalCommentsEl = document.getElementById('totalComments');
    const averageRatingEl = document.getElementById('averageRating');
    const commentsListEl = document.getElementById('commentsList');
    const noCommentsEl = document.getElementById('noComments');

    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const commentInput = document.getElementById('comment');
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const commentError = document.getElementById('commentError');

    const starRatingEl = document.getElementById('starRating');
    const selectedRatingEl = document.getElementById('selectedRating');

    let currentRating = null;

    // Create interactive stars (1-5)
    function createStars() {
      starRatingEl.innerHTML = '';
      for (let i = 1; i <= 5; i++) {
        const span = document.createElement('span');
        span.className = 'star';
        span.dataset.value = i;
        span.innerHTML = '★'; // star glyph
        span.setAttribute('role', 'radio');
        span.setAttribute('aria-checked', 'false');
        span.setAttribute('tabindex', '0');

        // click
        span.addEventListener('click', () => {
          setRating(i);
        });
        // keyboard: Enter/Space or Arrow keys
        span.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            setRating(i);
          } else if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') {
            e.preventDefault();
            setRating(Math.max(1, i-1));
            starRatingEl.querySelector([data-value="${Math.max(1,i-1)}"]).focus();
          } else if (e.key === 'ArrowRight' || e.key === 'ArrowUp') {
            e.preventDefault();
            setRating(Math.min(5, i+1));
            starRatingEl.querySelector([data-value="${Math.min(5,i+1)}"]).focus();
          }
        });
        starRatingEl.appendChild(span);
      }
      updateStarVisuals();
    }

    function setRating(value) {
      if (currentRating === value) {
        // toggle off if clicked again
        currentRating = null;
      } else {
        currentRating = value;
      }
      updateStarVisuals();
    }

    function updateStarVisuals() {
      for (const s of starRatingEl.querySelectorAll('.star')) {
        const v = Number(s.dataset.value);
        if (currentRating !== null && v <= currentRating) {
          s.classList.add('active');
          s.setAttribute('aria-checked', 'true');
        } else {
          s.classList.remove('active');
          s.setAttribute('aria-checked', 'false');
        }
      }
      selectedRatingEl.textContent = currentRating ? ${currentRating} / 5 : 'Not rated';
    }

    // Validation functions
    function validateName(name) {
      if (!name || name.trim().length === 0) {
        return 'Name should be between 2 and 50 characters';
      }
      const len = name.trim().length;
      if (len < 2 || len > 50) {
        return 'Name should be between 2 and 50 characters';
      }
      return '';
    }
    function validateEmail(email) {
      if (!email) return '';
      // simple check to ensure it contains @ (as per spec)
      if (!/@/.test(email)) {
        return 'Please enter a valid email address';
      }
      return '';
    }
    function validateComment(text) {
      if (!text || text.trim().length === 0) {
        return 'Comment should be between 10 and 500 characters';
      }
      const len = text.trim().length;
      if (len < 10 || len > 500) {
        return 'Comment should be between 10 and 500 characters';
      }
      return '';
    }

    // Render functions
    function renderStats() {
      totalCommentsEl.childNodes[0].nodeValue = comments.length;
      // calculate average rating among comments that have numeric rating
      const rated = comments.filter(c => typeof c.rating === 'number' && !isNaN(c.rating));
      if (rated.length === 0) {
        averageRatingEl.textContent = '—';
      } else {
        const avg = rated.reduce((s,c)=> s + c.rating, 0) / rated.length;
        // show one decimal if needed
        averageRatingEl.textContent = avg % 1 === 0 ? avg.toFixed(0) : avg.toFixed(1);
      }
    }

    function renderComments() {
      commentsListEl.innerHTML = '';
      if (comments.length === 0) {
        commentsListEl.appendChild(noCommentsEl);
        return;
      }
      // newest first
      for (let i = comments.length - 1; i >= 0; i--) {
        const c = comments[i];
        const card = document.createElement('div');
        card.className = 'comment';

        const header = document.createElement('div');
        header.className = 'comment-header';

        const left = document.createElement('div');
        const nameSpan = document.createElement('div');
        nameSpan.className = 'comment-name';
        nameSpan.textContent = c.name;
        left.appendChild(nameSpan);
        if (c.email) {
          const emailSpan = document.createElement('div');
          emailSpan.className = 'comment-email';
          emailSpan.textContent = c.email;
          left.appendChild(emailSpan);
        }

        const right = document.createElement('div');
        right.style.display = 'flex';
        right.style.gap = '8px';
        right.style.alignItems = 'center';
        const timeSpan = document.createElement('div');
        timeSpan.className = 'small-muted';
        const dt = new Date(c.timestamp);
        timeSpan.textContent = dt.toLocaleString();
        right.appendChild(timeSpan);

        if (typeof c.rating === 'number') {
          const ratingChip = document.createElement('div');
          ratingChip.className = 'rating-chip';
          ratingChip.textContent = ${c.rating} ★;
          right.appendChild(ratingChip);
        }

        header.appendChild(left);
        header.appendChild(right);

        const body = document.createElement('div');
        body.className = 'comment-body';
        body.textContent = c.comment;

        card.appendChild(header);
        card.appendChild(body);
        commentsListEl.appendChild(card);
      }
    }

    // Submit handler
    document.getElementById('commentForm').addEventListener('submit', (e) => {
      e.preventDefault();

      // reset errors
      nameError.textContent = '';
      emailError.textContent = '';
      commentError.textContent = '';

      const nameVal = nameInput.value || '';
      const emailVal = emailInput.value || '';
      const commentVal = commentInput.value || '';

      const nErr = validateName(nameVal);
      const emErr = validateEmail(emailVal);
      const cmErr = validateComment(commentVal);

      let hasError = false;
      if (nErr) { nameError.textContent = nErr; hasError = true; }
      if (emErr) { emailError.textContent = emErr; hasError = true; }
      if (cmErr) { commentError.textContent = cmErr; hasError = true; }

      if (hasError) return;

      const newComment = {
        name: nameVal.trim(),
        email: emailVal.trim() || null,
        comment: commentVal.trim(),
        rating: currentRating === null ? null : Number(currentRating),
        timestamp: Date.now()
      };

      // push into session array and immediately render
      comments.push(newComment);
      // Clear form fields after submission
      nameInput.value = '';
      emailInput.value = '';
      commentInput.value = '';
      currentRating = null;
      updateStarVisuals();

      // update UI
      renderStats();
      renderComments();

      // Optionally focus the name input for new comment
      nameInput.focus();
    });

    // "Clear All (session)" button — clears session array and UI
    document.getElementById('clearAll').addEventListener('click', () => {
      if (!confirm('This will clear all comments stored in this browsing session. Continue?')) return;
      comments.length = 0;
      renderStats();
      renderComments();
    });

    // Realtime small validations on blur/input (optional)
    nameInput.addEventListener('blur', () => {
      nameError.textContent = validateName(nameInput.value);
    });
    emailInput.addEventListener('blur', () => {
      emailError.textContent = validateEmail(emailInput.value);
    });
    commentInput.addEventListener('blur', () => {
      commentError.textContent = validateComment(commentInput.value);
    });

    // init
    createStars();
    renderStats();
    renderComments();
  </script>
</body>
</html>