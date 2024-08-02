<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: 'Kosugi Maru', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #5A3A7A; /* Dark purple text for contrast */
            background: #F5F5F5; /* Light grey background */
        }

        .welcome-container {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
            margin-bottom: 20px;
        }

        h1, p {
            margin: 0.5em 0;
        }

        h1 {
            color: #e3b4b8; /* Soft pink */
            font-size: 2.5em;
        }

        p {
            color: #ec2b24; /* Dark purple */
            font-size: 1em;
        }

        /* Minimal hover effect for links */
        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Fade in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Card module styling */
        .cards-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-container {
            width: 300px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            margin: 20px;
        }

        .card-container h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }

        .card-container p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }
    </style>
</head>
<body>

<div class="">
    <div class="welcome-container">
        <h1>Welcome to My Zone!</h1>
        <p>Your journey starts here.</p>
    </div>
</div>


<!-- Card Module -->
<div class="cards-wrapper">
    <div class="card-container">
        <h2>手机流量卡</h2>
        <p><a href="https://hk.usim.vip/h5#/?promoCode=vhfksgJk">前往免费办理流量卡</a></p>
    </div>
    <div class="card-container">
        <h2>颜色</h2>
        <p><a href="/color">偷的功能</a></p>
    </div>
    <div class="card-container">
        <h2>待定</h2>
        <p>还没想好放什么.</p>
    </div>
</div>
</body>
</html>

