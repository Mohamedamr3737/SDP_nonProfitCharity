
<form class="custom-form member-login-form" id="signForm" method="POST" action="/signup">
    <div class="mb-4">
        <label class="form-label mb-2" for="firstName">First Name</label>
        <input class="form-control" type="text" name="firstName" placeholder="First Name" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="lastName">Last Name</label>
        <input class="form-control" type="text" name="lastName" placeholder="Last Name" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="phone">Phone</label>
        <input class="form-control" type="number" name="phone" placeholder="01000000000" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="type">Type</label>
        <select class="form-control" name="type" id="typeSelect" required>
            <option value="donor">Donor</option>
            <option value="volunteer">volunteer</option>
            <option value="beneficiary">Beneficiary</option>
        </select>
    </div>

        <!-- Hidden skills dropdown for volunteers -->
    <div class="mb-4 d-none" id="skillsDropdown">
        <label class="form-label mb-2" for="skills">Select Your Skill</label>
        <select class="form-control" name="skills">
            <option value="teaching">Teaching</option>
            <option value="coding">Coding</option>
            <option value="healthcare">Healthcare</option>
            <option value="event_management">Event Management</option>
            <option value="others">Others</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="Email" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="password">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="rePassword">Re. Password</label>
        <input class="form-control" type="password" name="rePassword" placeholder="Password" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="login_type">Login Type</label>
        <select name="login_type" class="form-control">
            <option value="email">Email</option>
            <option value="social">Social Media</option>
        </select>
    </div>
    <div id="signupAlertMessage" class="alert d-none" role="alert"></div>


    <div class="col-lg-5 col-md-7 col-8 mx-auto">
        <button type="submit" class="form-control">Signup</button>
    </div>
</form>
<script>

// JavaScript to toggle skills dropdown based on type selection
document.getElementById("typeSelect").addEventListener("change", function () {
        const skillsDropdown = document.getElementById("skillsDropdown");

        if (this.value === "volunteer") {
            skillsDropdown.classList.remove("d-none");
        } else {
            skillsDropdown.classList.add("d-none");
        }
    });
document.getElementById("signForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        const signupAlert = document.getElementById("signupAlertMessage");
        console.log(data)
        if (data.statusCode === 200) {
            // Display success message and set alert to success style
            signupAlert.classList.remove("d-none", "alert-danger");
            signupAlert.classList.add("alert-success");
            signupAlert.textContent = data.message;

            // Optionally, clear the form fields
            document.getElementById("signupForm").reset();

        } else if (data.statusCode === 400) {
            // Display error message and set alert to danger style
            signupAlert.classList.remove("d-none", "alert-success");
            signupAlert.classList.add("alert-danger");
            signupAlert.textContent = data.message;
        }else if (data.statusCode === 409){
            signupAlert.classList.remove("d-none", "alert-success");
            signupAlert.classList.add("alert-danger");
            signupAlert.textContent = data.error;
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});
</script>
