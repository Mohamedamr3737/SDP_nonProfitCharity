<div class="container my-5">
    <div class="card">
        <div class="card-body text-center">
            <h2 class="card-title">Help Us Reach Our Community Goal!</h2>
            <p id="donationTracker" class="lead text-success">Donation Goal Progress: 0%</p>
            <p id="game_message" class="text-secondary">Answer questions to contribute to our goal!</p>
            
            <div id="question" class="mb-4 font-weight-bold">Loading question...</div>

            <div id="answers" class="d-flex flex-wrap justify-content-center"></div>

            <div id="feedback" class="my-3"></div>

            <button id="actionButton" class="btn btn-primary mt-4" onclick="startQuiz()">Start Quiz</button>
        </div>
    </div>
</div>

<!-- Link to external JavaScript file -->
<script src="/Assets/js/game.js"></script>