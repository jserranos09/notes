<?php
    
    $loggedIn = true;
    $array = [1,2,3,4,5];

    if($loggedIn){
        echo 'You are logged in' . '<br>';
    } else {
        echo 'You are not logged in';
    }
// another way to write the line above
//  echo ($loggedIn) ? 'if true' : 'if not true';
    echo  ($loggedIn) ? 'You are logged in'. '<br>' : 'You are not logged in';

// assigning a variables based on conditions 
    $isRegisted = ($loggedIn == true) ? true : false;
// prints true
    echo $isRegisted . '<br>';


    $age = 20;
    $score = 15;
// if score > 10, then check if age > 10. then average. Exceptional if under 10.
    echo 'Your score is: ' .($score > 10 ? ($age > 10 ? 'Average' : 'Exceptional'
// if score < 10 and age > 10, score is horrible. if age under 10, average
    ):($age > 10 ? 'Horrible':'Average'));

    echo '<br>';
?>
<!----------------------------------------------->
<!-- php inside html -->
<div>
    <?php if($loggedIn){ ?>
        <h3>Welcome User</h3>
    <?php } else{ ?>
        <h3>Welcome person</h3>
    <?php } ?>
</div>
<!-- another way to do the code above -->
<div>
<?php if($loggedIn): ?>
    <h3>Welcome persons</h3>
<?php else: ?>
    <h3>Welcome Guest</h3>
<?php endif; ?>
</div>

<div>
<!-- counts from 1 to 10 and puts in a list -->
<?php for($i = 0;$i <10;$i++): ?>
    <li><?php echo $i; ?></li>
<?php endfor; ?>
</div>