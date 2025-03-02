<html>
    <head>
        <title>TIKTAKTOK</title>
    </head>
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
<body>
    <div class="msg-container hide">
        <p id="msg">winner</p>
        <button id="new-btn">New Game</button>
    </div>
    <main>
        <h1>Tic Tac Toe</h1>
        <div class="container">
            <div class="game">
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
                <button class="box"></button>
            </div>
        </div>
        <button id="reset">Reset Game</button>
    </main>

    <script>
        let boxes = document.querySelectorAll(".box");
        let resetBtn = document.querySelector("#reset");
        let turnO = true;
        let newGameBtn = document.querySelector("#new-btn");
        let msgContainer = document.querySelector(".msg-container");
        let msg = document.querySelector("#msg");

        const winPatterns = [
            [0, 1, 2],
            [0, 3, 6],
            [0, 4, 8],
            [1, 4, 7],
            [2, 5, 8],
            [2, 4, 6],
            [3, 4, 5],
            [6, 7, 8]
        ];

        boxes.forEach((box) => {
            box.addEventListener('click', function(){
                currentSymbol = turnO ? 'O' : 'X';

                let existingSymbols = Array.from(boxes).map(b => b.innerText);
                let countO = existingSymbols.filter(s => s === 'O').length;
                let countX = existingSymbols.filter(s => s === 'X').length;

                if((turnO && countO >= 3) || (turnO && countX >= 3)){
                    let toRemove = currentSymbol;
                    let removed = 0;
                    
                    boxes.forEach(b => {
                        if(b.innetText === toRemove && romoved < 1){
                            b.innerText ='';
                            b.disabled = false;
                            removed++;
                        }
                    });
                }

                box.innerText = currentSymbol;
                box.style.color = turnO ? 'green' : 'black';
                box.disabled = false;

                turnO = !turnO;

                checkWinner();

            });
        });

        const enableBoxes = () => {
            for(let box of boxes){
                box.disabled = false;
                box.innerText = "";
            }
        };

        const disableBoxes = () => {
            for(let box of boxes){
                box.disabled = true;
            }
        };

        const showWinner = (winner) => {
            msg.innerText = `selamat pemenangnya adalah ${winner}`;
            console.log(msg.innerText);
            msgContainer.classList.remove('hide');
            disableBoxes();
        };

        const checkWinner = () => {
            let hasWin = false;
            for (let pattern of winPatterns){
                let pos1Val = boxes[pattern[0]].innerText;
                let pos2Val = boxes[pattern[1]].innerText;
                let pos3Val = boxes[pattern[2]].innerText;
            
                if(pos1Val !=="" && pos2Val !=="" && pos3Val !==""
                    && pos1Val === pos2Val && pos2Val === pos3Val
                 ){
                   showWinner(pos1Val);
                   hasWin = true;
                   return;
                 }
            }

            if(!hasWin){
                const allBoxes = [...boxes].every((box) => box.innerText !== "");
                if(allBoxes){
                    msgContainer.classList.remove('hide');
                    msg.innerText = 'Match Draw';
                }
            }
        };

        const resetGame = () => {
            turnO = true;
            enableBoxes();
            msgContainer.classList.add('hide');
        };

        newGameBtn.addEventListener('click', resetGame);
        resetBtn.addEventListener('click', resetGame);
    </script>
</body>
</html>