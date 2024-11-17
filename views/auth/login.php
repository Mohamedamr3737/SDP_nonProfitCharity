<form class="custom-form member-login-form" id="loginForm" method="POST" action="/login">
    <div id="alertMessage" class="alert alert-danger d-none" role="alert"></div>

    <div class="mb-4">
        <label class="form-label mb-2" for="email">Membership No.</label>

        <input type="email" name="email" id="email" class="form-control" placeholder="aaaa@example.com" required>
    </div>
    <div class="mb-4">
        <label class="form-label mb-2" for="member-login-number">Membership No.</label>

        <input type="password" name="password" id="password" class="form-control" placeholder="" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="login_type">Login type</label>

        <select name="login_type" class="form-control" id="login_type">
            <option value="email">Email</option>
            <option value="social">Social Media</option>
        </select>
    </div>
    <div class="col-lg-5 col-md-7 col-8 mx-auto">
        <button type="submit" class="form-control">Login</button>
    </div>


</form>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent default form submission

    // Get form data
    const formData = new FormData(this);

    // Send AJAX request
    fetch(this.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        const alertMessage = document.getElementById("alertMessage");

        if (data.statusCode === 401) {
            // Show error message
            alertMessage.classList.remove("d-none");
            alertMessage.textContent = data.message;
        } else if (data.statusCode === 200) {
            // Redirect on success or show success message
            window.location.href = "/"; // Adjust the redirect URL as needed
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
</script>

