<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kosugi Maru', sans-serif;
            display: flex;
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

        }

        h1, p {
            margin: 0.5em 0;
        }

        h1 {
            color: #FF69B4; /* Soft pink */
            font-size: 2.5em;
        }

        p {
            color: #5A3A7A; /* Dark purple */
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
    </style>
</head>
<body>

<div class="welcome-container">
    <h1> Welcome to Our Site!</h1>
    <p>Your journey starts here.</p>
</div>
</body>
</html>

