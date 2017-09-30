<?php
$cardNumbers = array();
$scores = array();
$players = array("BatMan", "WonderWoman", "SuperMan", "Joker");
$playerNum = 0;

for($i = 1; $i <= 52; $i++)
{
    $cardNumbers[] = $i;
    // Creates an array using the numbers 1 to 52
    // Each number represents a different card
}

function getHand() {

    global $cardNumbers;
    global $scores;
    $playerHand = array(); // This array holds the card numbers that are drawn
    $done = TRUE;
    $score = 0;
    while($done)
    {
        $newCard = rand(1, 52);
        if($cardNumbers[$newCard-1] != 0) // if the number == 0, then it has already been used
        {
            $playerHand[] = $newCard; // The new number is placed in the array
            $cardNumbers[$newCard - 1] = 0; // The number is then replaced so that it can't be used again

            if($newCard % 13 == 0)
            {
                $score += 13;
                    // If the card number mod 13 == 0, then the card is a king.  The point value is adjusted accordingly
            }
            else
            {
                $score += ($newCard % 13);
                // $newCard mod 13 will give the correct point values for all cards except kings
            }

        }
        if($score >= 42)      // If the score is equal to or greater than 42, no more cards are drawn
        {
            $done = FALSE;
        }
    }
    $scores[] = $score;
    displayHand($playerHand, $playerNym);
    // The new player hand array is returned
}
function displayHand($hand, $playerNum)
{
    global $scores;
    global $playerNum;
    global $players;
    echo "<img class='playerCard' src='players/" . $players[$playerNum] . ".jpg' />";
    if($players[$playerNum] == 'BatMan')
        {
            echo "<h2> BatMan </h2>";
        }
    else if($players[$playerNum] == 'SuperMan')
        {
            echo "<h2> SuperMan</h2>";
        }
    else if($players[$playerNum] == 'WonderWoman')
        {
            echo "<h2>WonderWoman</h2>";
        }
    else
    {
        echo "<h2>The Joker</h2>";
    }
    echo "<br> </br>";
   for($i = 0; $i < sizeof($hand); $i++) {
        echo "<img id='playingCards'  src='cards/". $hand[$i] . ".png' />";
        }
    echo "<h2 id='score' > Score: " . $scores[$playerNum] . " </h2>";
    $playerNum++;
    echo "<br> </br>";
}
function displayWinner() {
  //global variables
         global $scores;
         global $players;
         $winner = 0;
         $lowScore = 0;
         $totalScore = 0;
         $closest=$score[0];
         for( $i= 0; $i < 4; $i++ )// finds out who the winner is
         {
             $lowScore=($score[$i]-42);

             if($lowScore<$closest)
             {
                 $closest = $lowScore;
                 $winner = $i;
             }
         }

         for($j=0; $j<4; $j++) //prints out the winner out of the 4 players
         {
            if($j != $winner)
            {
             $totalScore = $totalScore + $scores[$j];
            }
             }
             //prints out the winner
         echo 'The Winner is: ';
         if($players[$winner] == 'BatMan')
            {
                echo 'BatMan. The Score is: ' . $totalScore;
            }
        else if($players[$winner] == 'SuperMan')
            {
                echo 'SuperMan. The Score is: ' . $totalScore;
            }
        else if($players[$winner] == 'WonderWoman')
            {
                echo 'WonderWoman. The Score is: ' . $totalScore;
            }
        else
            {
                echo 'The Joker. The Score is: ' . $totalScore;
            }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>SilverJack </title>

           <link href="style.css" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <h1> SilverJack </h1>
        <div class='hands'>
        <?php
            shuffle($players);
            for($j = 0; $j < 4; $j++){
                getHand();
            }
            displayWinner();
        ?>
        </div>
        
        <hr>
    </body>
</html>