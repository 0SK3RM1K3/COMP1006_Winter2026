<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
<<<<<<< HEAD

    Lab question:
     - From this lab i will use the concept of separating my work into distinguishable parts and organize the overall
     aplication through varying files. Ive learned that this is quite a handy trick and much more organized making for
     easy editing.
*/
$items = ["Home", "About", "Contact"];//variable list
require "header.php";//header separated into seperate file
?>

<!-- php generated list -->
=======
*/

$items = ["Home", "About", "Contact"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>My PHP Page</title>
</head>
<body>

<h1>Welcome</h1>

>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778
<ul>
<?php foreach ($items as $item): ?>
    <li><?= $item ?></li>
<?php endforeach; ?>
</ul>

<<<<<<< HEAD
<?php
require "footer.php";//footer separated into seperate file
?>

=======
<footer>
    <p>&copy; 2026</p>
</footer>

</body>
</html>
>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778
