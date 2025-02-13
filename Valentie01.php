<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สุขสันต์วันวาเลนไทน์ที่รัก</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #ffe6e6;
            color: #d63384;
            margin: 0;
            padding: 50px;
            overflow: auto; /* Change to hidden to hide overflow */
        }
        h1 {
            font-size: 3em;
        }
        .heart {
            font-size: 5em;
            color: Red;
            animation: heartbeat 1.5s infinite;
        }
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        .message {
            font-size: 1.5em;
            margin-top: 20px;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
            word-wrap: break-word;
        }
        .memory {
            margin-top: 30px;
            font-size: 1.2em;
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
            word-wrap: break-word;
        }
        .slider {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .slider img {
            width: 300px;
            height: 250px; /* Fixed height */
            object-fit: cover; /* Keep the aspect ratio */
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: opacity 0.5s ease-in-out;
        }
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1;
        }
        .prev {
            left: 0;
        }
        .next {
            right: 0;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; /* Hide overflow to fit content within one page */
        }
        .modal-content {
            position: relative;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 90%;
            max-width: 600px;
            max-height: 90%;
            overflow: hidden; /* Hide overflow to fit content within one page */
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modal img {
            width: 100%;
            height: 500px; /* Adjust this value if needed */
            object-fit: cover; /* Keep the aspect ratio */
            border-radius: 10px;
        }
        .modal-text {
            margin-top: 10px;
            max-height: 20%;
            overflow-y: auto;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
            color: black;
        }

        /* Falling hearts animation */
        .falling-heart {
            position: fixed;
            top: -100px;
            z-index: 999;
            animation: fall 5s infinite;
            pointer-events: none;
        }
        @keyframes fall {
            to {
                transform: translateY(120vh);
                opacity: 0;
            }
        }

        /* Media Query for smaller screens */
        @media (max-width: 600px) {
            h1 {
                font-size: 2em;
            }
            .heart {
                font-size: 4em;
            }
            .message {
                font-size: 1.2em;
                max-width: 100%;
                word-wrap: break-word;
            }
            .memory {
                font-size: 1em;
                max-width: 100%;
                word-wrap: break-word;
            }
            .slider {
                flex-direction: column;
            }
            .slider img {
                max-width: 100%;
                height: auto;
                margin: 10px 0;
            }
            .prev, .next {
                top: auto;
                bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>สุขสันต์วันวาเลนไทน์ที่รัก ❤️</h1>
    <div class="heart">❤❤❤</div>
    <p class="message">ที่รักของฉัน ขอให้วันนี้และทุกวันเต็มไปด้วยความรักและความสุข รักเธอเสมอ 💕</p>
    
    <div class="slider">
        <button class="prev" onclick="changeImage(-1)">❮</button>
        <img id="prev-image" src="image3.jpg" alt="ภาพแห่งความทรงจำ" style="opacity: 0.5;">
        <img id="slider-image" src="image1.jpg" alt="ภาพแห่งความทรงจำ" onclick="openModal()">
        <img id="next-image" src="image2.jpg" alt="ภาพแห่งความทรงจำ" style="opacity: 0.5;">
        <button class="next" onclick="changeImage(1)">❯</button>
    </div>
    
    <div class="memory">
        <h2>ความทรงจำของเรา</h2>
        <p id="memory-text">วันที่เราไปเที่ยวด้วยกัน ฉันยังจำรอยยิ้มของเธอได้ดี รักเธอเสมอ 💖</p>
    </div>
    
    <div id="image-modal" class="modal" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modal-image" src="">
            <p id="modal-text" class="modal-text"></p>
        </div>
    </div>
    
    <audio id="background-music" loop>
        <source src="background-music.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
        let images = ["Vl01.jpg","Vl10.jpg", "Vl09.jpg", "Vl08.jpg","Vl07.jpg"];
        let memories = [
            "วันที่เราไปเที่ยวด้วยกัน ฉันยังจำรอยยิ้มของเธอได้ดี รักเธอเสมอ 💖",
            "วันที่เราเดินจับมือกันใต้แสงดาว คืนนั้นเป็นคืนที่พิเศษที่สุด",
            "เมื่อครั้งที่เราหัวเราะด้วยกัน มันเป็นช่วงเวลาที่มีค่ามาก"
        ];
        let currentIndex = 0;

        function changeImage(step) {
            currentIndex = (currentIndex + step + images.length) % images.length;
            updateImageAndText();
        }

        function updateImageAndText() {
            document.getElementById("slider-image").src = images[currentIndex];
            document.getElementById("prev-image").src = images[(currentIndex - 1 + images.length) % images.length];
            document.getElementById("next-image").src = images[(currentIndex + 1) % images.length];
            document.getElementById("memory-text").innerText = memories[currentIndex];
        }

        function autoSlide() {
            changeImage(1);
            setTimeout(autoSlide, 10000);
        }

        function openModal() {
            document.getElementById("modal-image").src = images[currentIndex];
            document.getElementById("modal-text").innerText = memories[currentIndex];
            document.getElementById("image-modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("image-modal").style.display = "none";
        }

        function createFallingHeart() {
            const heart = document.createElement('div');
            heart.className = 'falling-heart';
            heart.innerHTML = '❤️';
            heart.style.left = Math.random() * 100 + 'vw';
            heart.style.animationDuration = Math.random() * 2 + 3 + 's';
            document.body.appendChild(heart);

            setTimeout(() => {
                heart.remove();
            }, 5000);
        }

        function startFallingHearts() {
            setInterval(createFallingHeart, 300);
        }

        function playMusic() {
            document.getElementById("background-music").play();
        }

        window.onload = function() {
            setTimeout(autoSlide, 10000);
            startFallingHearts();
            playMusic();
        };
    </script>
</body>
</html>