// Observable class for managing observers
class Observable {
    constructor() {
        this.observers = [];
    }

    subscribe(observer) {
        this.observers.push(observer);
    }

    notify(data) {
        this.observers.forEach(observer => observer(data));
    }
}

// Observables for different game states
const donationGoal = new Observable();        // Tracks points (progress toward donation goal)
const questionObservable = new Observable();   // Tracks the current question
const feedbackObservable = new Observable();   // Tracks feedback after each answer
const endGameObservable = new Observable();    // Tracks the end of the game

// Observers for each state
function updateDonationTracker(data) {
    document.getElementById('donationTracker').textContent = `Donation Goal Progress: ${data.points}%`;
}

function showEncouragementMessage(data) {
    const messageElement = document.getElementById('game_message');
    if (data.points >= 100) {
        messageElement.textContent = "Congratulations! You've helped reach the goal!";
    } else {
        messageElement.textContent = `Great job! Keep going to reach 100%!`;
    }
}

function displayQuestion(data) {
    const questionData = data.question;
    document.getElementById('question').textContent = questionData.question;

    const answersContainer = document.getElementById('answers');
    answersContainer.innerHTML = ''; // Clear previous answers
    questionData.choices.forEach(choice => {
        const answerButton = document.createElement('button');
        answerButton.classList.add('btn', 'btn-outline-primary', 'm-2');
        answerButton.textContent = choice;
        answerButton.onclick = () => checkAnswer(choice, questionData.correctAnswer);
        answersContainer.appendChild(answerButton);
    });
}

function showFeedback(data) {
    const feedback = document.getElementById('feedback');
    feedback.innerHTML = data.message;
    feedback.style.display = 'block';

    // Hide feedback after a delay
    setTimeout(() => {
        feedback.style.display = 'none';
    }, 1500);
}

function displayEndGameMessage() {
    document.getElementById('game_message').textContent = "Thank you for participating and learning with us!";
    document.getElementById('question').textContent = '';
    document.getElementById('answers').innerHTML = '';
}

// Subscribe observers to each observable
donationGoal.subscribe(updateDonationTracker);
donationGoal.subscribe(showEncouragementMessage);
questionObservable.subscribe(displayQuestion);
feedbackObservable.subscribe(showFeedback);
endGameObservable.subscribe(displayEndGameMessage);

let points = 0;
let currentQuestionIndex = 0;

// Custom questions for community help topics
const questions = [
    {
        question: "What percentage of the world’s population lives in extreme poverty?",
        choices: ["1%", "10%", "25%", "50%"],
        correctAnswer: "10%"
    },
    {
        question: "Which of the following diseases can be prevented by access to clean water?",
        choices: ["Malaria", "Diabetes", "Cholera", "Cancer"],
        correctAnswer: "Cholera"
    },
    {
        question: "What is the primary goal of non-profit organizations?",
        choices: ["Generate profit", "Increase shareholder value", "Serve the community", "Reduce taxes"],
        correctAnswer: "Serve the community"
    },
    {
        question: "Which of the following is a renewable energy source?",
        choices: ["Coal", "Natural Gas", "Wind", "Nuclear"],
        correctAnswer: "Wind"
    },
    {
        question: "Which organization helps provide food to those in need worldwide?",
        choices: ["World Health Organization", "World Food Programme", "UNICEF", "Greenpeace"],
        correctAnswer: "World Food Programme"
    }
];

// Start Quiz Function
function startQuiz() {
    document.getElementById('actionButton').style.display = 'none'; // Hide the Start Quiz button
    displayNextQuestion(); // Start displaying questions
}

// Display the next question
function displayNextQuestion() {
    if (currentQuestionIndex === questions.length) {
        endGameObservable.notify();
        return;
    }

    const questionData = questions[currentQuestionIndex];
    questionObservable.notify({ question: questionData });
}

// Check the answer and update points if correct
function checkAnswer(selectedAnswer, correctAnswer) {
    if (selectedAnswer === correctAnswer) {
        points = Math.min(points + 20, 100); // Each correct answer adds 20 points
        donationGoal.notify({ points });
        
        // Notify feedback observable with a clapping emoji for correct answer
        feedbackObservable.notify({ message: "👏 Correct! Great job!" });
    } else {
        // Notify feedback observable with an angry emoji for incorrect answer
        feedbackObservable.notify({ message: "😠 Incorrect! Try again!" });
    }

    // Move to the next question after feedback
    currentQuestionIndex++;
    setTimeout(displayNextQuestion, 500); // Short delay to show feedback
}

// End the game
function endGame() {
    endGameObservable.notify();
}
