
    <script>
        // Show/hide fields based on donation type selection
        function toggleFields() {
            const donationType = document.getElementById("donationType").value;
            document.getElementById("amountField").style.display = 
                donationType === "online" || donationType === "check" || donationType === "in-kind" ? "block" : "none";
            document.getElementById("productField").style.display = 
                donationType === "product" ? "block" : "none";
            document.getElementById("serviceField").style.display = 
                donationType === "service" ? "block" : "none";
            document.getElementById("paymentMethodField").style.display = 
                donationType === "online" ? "block" : "none";
        }

        // Submit the form using AJAX to handle JSON response from backend
        async function submitDonationForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            try {
                const response = await fetch('/submit_donation', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                console.log(result)
                console.log(result.receipt)
                console.log(result.paymentMessage)
                document.getElementById("message").innerHTML="";
                document.getElementById("receiptMessage").style.display="none";
                displayMessage((result.receipt?result.receipt+" ":"")+(result.totalAmount?result.totalAmount+ "\n":"" )+result.message, result.status === 'success',"message");
                if(result.paymentMessage)
                displayMessage(result.paymentMessage, result.status === 'success',"receiptMessage");
                document.getElementById("donationForm").reset(); // Reset form values


            } catch (error) {
                console.error('Error submitting donation form:', error);
                displayMessage('An error occurred. Please try again later.', false);
            }
        }

        // Display message in the UI
        function displayMessage(message, isSuccess ,divId) {
            const messageDiv = document.getElementById(divId);
            messageDiv.textContent = message;
            messageDiv.className = isSuccess ? 'alert alert-success' : 'alert alert-danger';
            messageDiv.style.display = 'block';
        }
    </script>

    <div class="container mt-5 ">
        <h2 class="mb-4">Create a Donation</h2>

        <!-- Message Display -->
        <div id="message" class="alert" style="display:none;"></div>
        <div id="contt">
        <div id="receiptMessage" class="alert" style="display:none;"></div>
        </div>
        
        <form onsubmit="submitDonationForm(event)" class="custom-form membership-form shadow-lg" id="donationForm">
            <!-- Donor Name -->

            
            <div class="form-floating">

                
                
                <input type="text" class="form-control" id="donorName" name="donorName" placeholder="">
                <label for="floatingInput">Donor Name: Keep empty if you don't want to change the donor name</label>
                
            </div>

            <!-- Donation Type -->
            <div class="form-floating">
                
                <select class="form-control" id="donationType" name="donationType" onchange="toggleFields()" aria-placeholder="" required>
                    <option value="">Select Type</option>
                    <option value="online">Online Money Donation</option>
                    <option value="check">Check Donation</option>
                    <option value="in-kind">In-Kind Money Donation</option>
                    <option value="product">Product Donation</option>
                    <option value="service">Service Donation</option>
                </select>
                <label for="floatingInput">Donation Type:</label>
            </div>

            <!-- Amount (for Money Donations) -->
            <div id="amountField" class="form-floating" style="display:none;">
                
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="">
                <label for="floatingInput">Amount</label>
            </div>

            <!-- Payment Method (for Online Donations) -->
            <div id="paymentMethodField" class="form-floating" style="display:none;">
                
                <select class="form-control" id="paymentMethod" name="paymentMethod">
                    <option value="stripe">Stripe</option>
                    <option value="paypal">PayPal</option>
                </select>
                <label for="floatingInput">Payment Method:</label>
            </div>

            <!-- Product Name (for Product Donations) -->
            <div id="productField" class="form-floating" style="display:none;">
                
                <input type="text" class="form-control" id="productName" name="productName" placeholder="">
                <label for="floatingInput">Product Name</label>
            </div>

            <!-- Service Description (for Service Donations) -->
            <div id="serviceField" class="form-floating" style="display:none;">
                
                <textarea class="form-control" id="serviceDescription" name="serviceDescription" rows="4" placeholder=""></textarea>
                <label for="floatingInput">Service Description:</label>
            </div>

            <div class="form-floating">
                <p style="color:white;">14% tax is applied</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Donation</button>
        </form>
    </div>

