<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: lightcyan;
            text-align: center;
        }
        .container {
            height: 70vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .game {
            height: 60vmin;
            width: 60vmin;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5vmin;
            justify-content: center;
        }
        .box {
            height: 18vmin;
            width: 18vmin;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 0 1rem rgba(0,0,0,0.3);
            font-size: 8vmin;
            color: red;
            background-color: yellow;
        }
        #reset {
            padding: 1rem;
            font-size: 1.25rem;
            background: #191913;
            color: white;
            border-radius: 1rem;
            border: none;
        }
        .box:hover {
            background-color: chocolate;
        }
        #new-btn {
            padding: 1rem;
            font-size: 1.25rem;
            background: #191913;
            color: white;
            border-radius: 1rem;
            border: none;
        }
        #msg {
            font-size: 8vmin;
        }
        .msg-container {
            height: 30vmin;
        }
        .hide {
            display: none;
        }
    </style>
</head>
<body>
    <div class="msg-container hide">
        <p id="msg">Winner</p>
        <button id="new-btn">New Game</button>
    </div>
    <main>
        <h1>Tic Tac Toe</h1>
        <div class="container">
            <div class="game">
                <button class="box" data-index="0"></button>
                <button class="box" data-index="1"></button>
                <button class="box" data-index="2"></button>
                <button class="box" data-index="3"></button>
                <button class="box" data-index="4"></button>
                <button class="box" data-index="5"></button>
                <button class="box" data-index="6"></button>
                <button class="box" data-index="7"></button>
                <button class="box" data-index="8"></button>
            </div>
        </div>
        <p id="status"></p>
        <button id="reset">Reset Game</button>
    </main>
    <script>
        const boxs = document.querySelectorAll('.box');
const statusText = document.querySelector('#status');
const restartBtn = document.querySelector('#reset');
let board = ['', '', '', '', '', '', '', '', ''];
let currentPlayer = 'X';
let running = true;

const winConditions = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8],
    [0, 3, 6], [1, 4, 7], [2, 5, 8],
    [0, 4, 8], [2, 4, 6]
];

function initializeGame() {
    boxs.forEach(box => box.addEventListener('click', boxClicked));
    restartBtn.addEventListener('click', restartGame);
    statusText.textContent = `Player ${currentPlayer}'s turn`;
    running = true;
}

function boxClicked() {
    const boxIndex = this.getAttribute('data-index');
    if (board[boxIndex] !== '' || !running) {
        return;
    }
    updatebox(this, boxIndex);
    checkWinner();
    if (running) {
        botMove();
    }
}

function updatebox(box, index) {
    board[index] = currentPlayer;
    box.textContent = currentPlayer;
}

function changePlayer() {
    currentPlayer = (currentPlayer === 'X') ? 'O' : 'X';
    statusText.textContent = `Player ${currentPlayer}'s turn`;
}

function checkWinner() {
    for (const condition of winConditions) {
        const [a, b, c] = condition;
        if (board[a] && board[a] === board[b] && board[a] === board[c]) {
            statusText.textContent = `Player ${board[a]} wins!`;
            running = false;
            return;
        }
    }
    if (!board.includes('')) {
        statusText.textContent = 'Draw!';
        running = false;
    } else {
        changePlayer();
    }
}

function botMove() {
    let emptybox = board.map((val, idx) => (val === '' ? idx : null)).filter(val => val !== null);
    if (emptybox.length > 0) {
        let randomIndex = emptybox[Math.floor(Math.random() * emptybox.length)];
        board[randomIndex] = currentPlayer;
        boxs[randomIndex].textContent = currentPlayer;
        checkWinner();
    }
}

function restartGame() {
    board = ['', '', '', '', '', '', '', '', ''];
    boxs.forEach(box => (box.textContent = ''));
    currentPlayer = 'X';
    statusText.textContent = `Player ${currentPlayer}'s turn`;
    running = true;
}

initializeGame();


    </script>
</body>
</html>
