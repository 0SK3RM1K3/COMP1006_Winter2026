Dad Joke API Demo Files
=======================

Files included:
- random_joke.php   -> loads one random joke from the API
- search_jokes.php  -> searches the API using a student-entered keyword

How to use:
1. Place the folder inside your htdocs or web root.
2. Start Apache in XAMPP.
3. Open the files in a browser, for example:
   http://localhost/dad_joke_api_demo/random_joke.php
   http://localhost/dad_joke_api_demo/search_jokes.php

Teaching notes:
- These files use descriptive comments for live-coding or walkthroughs.
- They use the icanhazdadjoke API.
- The API is asked to return JSON using the Accept header.
- A custom User-Agent header is also included as recommended by the API docs.
