let canvas, context;

function initializeCanvas() {
    canvas = document.getElementById('myCanvas');
    context = canvas.getContext('2d');
    resizeCanvas();
}
function resizeCanvas() {
    canvas.width = window.innerWidth - 20;
    canvas.height = window.innerHeight - 20;
}
window.addEventListener('resize', resizeCanvas);
initializeCanvas();


let score = 0;
let scoreDisplay = document.createElement("p"); 
scoreDisplay.id = "scoreDisplay";
document.body.appendChild(scoreDisplay);
let questionbox = document.createElement("p");
questionbox.id = "questionbox";
document.body.appendChild(questionbox);

let flash = null;
let scoreMultiplier = 1;

let quiz = [];
//this is the fisher-yates shuffle i put into practise https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle
//this randomises the order my questions come up
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }//i have decided to shuffle the arrays order instead of randomiseing which number of question will be selected to include more complex code
}

    function loadQuizData(jsonFile) {
        fetch(jsonFile)
            .then(response => response.json())
            .then(data => {
                quiz = data;
                shuffleArray(quiz);
            })
            .catch(error => console.error('Error loading data:', error));
    }
    
    function chooseJSON(level) {
        let fileName;
        switch (level) {
            case '1':
                scoreMultiplier = 1;
                fileName = 'questions/quiz.json';// i used chatGPT to genrate lost of questions for ease
                break;
            case '2':
                scoreMultiplier = 1.5;
                fileName = 'questions/quiz2.json';
                break;
            case '3':
                scoreMultiplier = 2;
                fileName = 'questions/quiz3.json';
                break;
            default:
                scoreMultiplier = 1;
                fileName = 'questions/quiz.json'; 
        }//if they just type in the URL, error handling so game doenst break
        return fileName;
    }

    var jsonFile = chooseJSON(level);
    loadQuizData(jsonFile);




const pull=0.5
let timeLeft = 60;//global as used in many functions

let lastAns = null;
let correctAns = false;

let timer = document.createElement("p");
timer.id = "timer";
document.body.appendChild(timer);
let countdown;

let currentQuestionIndex = 0;
function updateQuestion() {
    if(currentQuestionIndex < quiz.length) {
        questionbox.textContent = quiz[currentQuestionIndex].question;
    }

    //all json files are the same length, never going to run out of questions, because of one second timeout, 60/61 max, i have duplicated all questions to make sure they will never reach end to question list, with more time i would add more questions
}
function nextQuestion() {
    currentQuestionIndex++;
    updateQuestion();
}

// making character/sprite that moves down(movement)
class Player{
    constructor(position){
        this.position=position
        this.movement={
            x:0,
            y:1,
        }
    this.height=75
    this.width=43
    this.onSurface = false;
    this.image = new Image();
    this.image.src = 'images/characterdog.png';


}

draw() {
    context.drawImage(this.image, this.position.x, this.position.y, this.width, this.height);
}
//creating the way that the file can update the position of the player in realtime which will be ran during the animate function to create a constant updte as it goes on
    update() {
        this.position.x += this.movement.x
        this.position.y += this.movement.y

        let onPlatform = false
        this.onSurface = false;
        for(let platform of platforms) {//using for loop
            if(this.colliding(platform)) {onPlatform = true
                this.position.y = platform.y - this.height
                this.movement.y = 0
                this.onSurface = true;
            }
        }
        if (this.position.x < 0) { 
            this.position.x = 0;
        } else if (this.position.x + this.width > canvas.width) {
            this.position.x = canvas.width - this.width;
        }
        if(!onPlatform) {
            if(this.position.y + this.height + this.movement.y < canvas.height) {
                this.movement.y += pull
            } else {
                this.movement.y = 0
                this.onSurface = true;
            }
        }
    }
//collision-this is so the sprite doesnt fall through the platforms
    colliding(platform) {
        const ifFalling = this.position.y + this.movement.y
        const sideHit = this.position.x < platform.x + platform.width && this.position.x + this.width > platform.x
        const topHit = ifFalling + this.height > platform.y && this.position.y + this.height <= platform.y
        const standOnPlatform = this.position.y + this.height == platform.y && this.movement.y == 0
        return sideHit && (topHit || standOnPlatform)
    }
}


//sprite 
const player= new Player({
    x:0,
y:0,})
//coding the buttons inputs and what they do
const wasd ={
    d:{
        pressed:false,
    },
    a:{
        pressed:false
    },
    ArrowRight:{
        pressed:false
    },
    ArrowLeft:{
        pressed:false
    },
    }

    //creating the platforms
const platforms=[
    {x:600,y:400,width:100,height:10},
    {x:900,y:300,width:100,height:10},
    {x:200,y:100,width:100,height:10},
    {x:400,y:500,width:100,height:10},
    {x:100,y:500,width:100,height:10},
    {x:200,y:350,width:100,height:10},
    {x:500,y:100,width:100,height:10},
    {x:850,y:250,width:100,height:10},
    {x:650,y:300,width:100,height:10},
    {x:5,y:200,width:100,height:10},
    {x:1220,y:400,width:100,height:10},
    {x:1150,y:500,width:100,height:10},
    {x:1350,y:650,width:100,height:10},
    {x:400,y:650,width:100,height:10},
    {x:700,y:550,width:100,height:10},
    {x:1300,y:300,width:100,height:10},
    
]//add
const teleImage = new Image();
teleImage.src = 'images/door.jpg';


const teleporters = [
    { x: canvas.width - 100, y: 50, width: 60, height: 75, image: teleImage },
    { x: 0, y: canvas.height - 80, width: 60, height: 75, image: teleImage },
];

const answers = [
    {x:120,y:200,width:50,height:50,text: 'Answer ', answerCount: 0},
    {x:620,y:340,width:50,height:50,text: 'Answer ', answerCount: 1},
    {x:530,y:40,width:50,height:50,text: 'Answer ', answerCount: 2},
    {x:1400,y:700,width:50,height:50,text: 'Answer ', answerCount: 3} 
]//add

//teleporter functions
function teleCollision() {
    for (let teleporter of teleporters) {
        if (
            player.position.x < teleporter.x + teleporter.width &&
            player.position.x + player.width > teleporter.x &&
            player.position.y < teleporter.y + teleporter.height &&
            player.position.y + player.height > teleporter.y) {
            return teleporter;}
    }
return null;
}
let teleportCooldown = false;
function teleport(teleporter) {
    if (teleporter.x === 0 && teleporter.y === canvas.height - 80) { 
        player.position.x = canvas.width - player.width - 100; 
        player.position.y = 50;
    } else { 
        player.position.x = 50;
        player.position.y = canvas.height - player.height - 150;}
    setTimeout(() => {teleportCooldown = false;},1000);
}

function sendScoreToServer(score) {
    console.log("Sending score:", score);
    fetch('game.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'score=' + score
    })
    .then(response => response.text())
    .then(data => {
        console.log("Response from server:", data);
    })
    .catch(error => console.error('Error:', error));
}
//cretaing a function to start the timer
//coding this took forever as i couldnt figure out why the concatinating wasnt working, i had to use a DOM method of timer.textContent otherwise it doesnt work(write about in testing)
function startTimer() {
    timer.textContent = timeLeft + " seconds remaining";//concatenating the active timer and the seconds remaining text
    countdown = setInterval(function() {
        timeLeft=timeLeft - 1;
        timer.textContent = timeLeft + " seconds remaining";
        if(timeLeft <= 0) {
            clearInterval(countdown);
            window.location.href = "scores.php"; 
        }
    }, 1000);
}
function countScore() {
    scoreDisplay.textContent = "Score: " + score; 
}

function updateScore(isCorrect) {
    if (isCorrect) {
        let points = 10; 
        if (quiz[currentQuestionIndex].isBonus) {
            points = 20; 
        }
        if (timeLeft <= 10) {
            points *= 2; 
        }
        points *= scoreMultiplier; 
        score += points;
    }
    countScore(); 
    sendScoreToServer(score);
}


let qDelay = false;
function checkAnswerCollision() {
    if (qDelay) {
        return null;
    }
    else{
    for(let answer of answers) {
        if (player.position.x < answer.x + answer.width &&
            player.position.x + player.width > answer.x &&
            player.position.y + player.height > answer.y &&
            player.position.y < answer.y + answer.height) {
            return answer
        }
    }
    return null
}}
function build(){
    function createAnswers(){
    if (currentQuestionIndex < quiz.length) {
        const currentAnswers = quiz[currentQuestionIndex].answers;
        context.fillStyle = 'blue';
    
        answers.forEach((answer, index) => {

            context.font = '16px Arial';
            context.textAlign = 'left';

            answer.text = currentAnswers[index];
            context.fillRect(answer.x, answer.y, answer.width, answer.height);
            context.fillStyle = 'white';
            context.fillText(answer.text, answer.x + 10, answer.y + 30);
            context.fillStyle = "blue";
        });
    }
}
function drawTeleporters() {
    for (let teleporter of teleporters) {
        context.drawImage(teleporter.image, teleporter.x, teleporter.y, teleporter.width, teleporter.height);
    }
}
function drawPlatform(platform){
    context.fillStyle = "black"
    context.fillRect(platform.x, platform.y, platform.width, platform.height)
}//creating functions to fufill
drawTeleporters()
for(let platform of platforms) {
    drawPlatform(platform)

}
createAnswers()

}



let timerRunning = false;
if (!timerRunning) {
    startTimer();
    countScore();

    timerRunning = true;}
const background = new Image();
background.src = 'images/background.jpg';
background.onload = function() {
context.drawImage(background, 0, 0, canvas.width, canvas.height);}


function animate(){
    window.requestAnimationFrame(animate)
    context.drawImage(background, 0, 0, canvas.width, canvas.height);
    const collidedAnswer = checkAnswerCollision()
    if (collidedAnswer && !qDelay) {
        qDelay = true;
        const correctAnswer = quiz[currentQuestionIndex].correct;
        let isCorrect = collidedAnswer.text.trim() === correctAnswer;
        
        //trim function so it gets rid of spaces and works;good practise
        if (collidedAnswer.text.trim() === correctAnswer) {
            if (quiz[currentQuestionIndex].isBonus) {
                console.log("Correct");
 
                flash = 'rgba(128, 0, 128, 0.5)'
                updateScore(isCorrect);}
                else{
            console.log(`Correct: ${collidedAnswer.text}`);
            
            countScore();
            updateScore(isCorrect);
            flash = 'rgba(0, 255, 0, 0.5)';}
            //answer box flash transparent green
        } else {
            //answer box transparent flash red
            flash = 'rgba(255, 0, 0, 0.5)';
            console.log(`Incorrect: ${collidedAnswer.text}`);
        }
        setTimeout(() => {
            nextQuestion();
            flash = null;
            qDelay = false; 
        }, 1000); 
  
    }

    const collidedTeleporter = teleCollision();
    if (collidedTeleporter) {
        teleport(collidedTeleporter);
    }



    function setFlash() {
        flash = 'rgba(255, 255, 0, 0.5)';
        setTimeout(function() {
            flash = null;
        }, 500); 
    }
    if (timeLeft === 10) {
        setFlash();
    }
    

    player.draw()
    player.update()
    updateQuestion();
    build()
    countScore()
    player.movement.x=0
    if(wasd.d.pressed) player.movement.x=5
        else if(wasd.a.pressed) player.movement.x=-5
    else if(wasd.ArrowRight.pressed) player.movement.x=5
        else if(wasd.ArrowLeft.pressed) player.movement.x=-5


    if (flash) {
        context.fillStyle = flash;
        context.fillRect(0, 0, canvas.width, canvas.height);
    }  
}

animate()



function handleKeyPress(event) {
    console.log(event);
    switch(event.key) {
        case "d": 
            wasd.d.pressed = true;
            break;
        case "a":
            wasd.a.pressed = true;
            break;
        case "w":
            if (player.onSurface) {
                player.movement.y = -13;
            }
            break;
        case "ArrowRight":
            wasd.ArrowRight.pressed = true;
            break;
        case "ArrowLeft":
            wasd.ArrowLeft.pressed = true;
            break;
        case "ArrowUp":
            if (player.onSurface) {
                player.movement.y = -13;
            }
            break;
        case " ":
            player.movement.y = -13;
            break;
        default:
            console.log("Unhandled key press:", event.key);
    }
}
window.addEventListener("keydown", (event) => {
    try {
        handleKeyPress(event);
    } catch (error) {
        console.error("Error occurred in keydown handler:", error);
    }//error handling
});
window.addEventListener("keyup",(clicked) =>{
    console.log(clicked)//test if clicked
    switch(clicked.key){
        //wasd
        case"d": 
        wasd.d.pressed=false
        break
        case"a":
        wasd.a.pressed=false
        break
        case"ArrowRight": 
        wasd.ArrowRight.pressed=false
        break
        case"ArrowLeft":
        wasd.ArrowLeft.pressed=false
        break
    }
})

//if player croosses +100 score in how many seconds
//if plahy game clicked +1 games played in table 
//if the average score uses php

