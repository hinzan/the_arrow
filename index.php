<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <?php
        $grid  = 49;

	$xx = 0;
	$yy = 6;
    ?>
    <div class="grid">

        <?php for ($x = 1; $x <= 49; $x++) {?>
            <?php
                /*if($x == 1){
                    $class_initial = 'fas fa-arrows-alt';
                }else if($x == 2){
                    $class_initial = 'fas fa-arrow-up';
                } else if($x == 3){
                    $class_initial = 'fas fa-arrow-down';
                }else if($x == 4){
                    $class_initial = 'fas fa-arrow-right';
                }else if($x == 5){
                    $class_initial = 'fas fa-arrow-left';
                }else{
                    $class_initial = '';
                }*/

		
            ?>
            <div class="child-grid <?php echo($class_initial)?> <?php echo $xx++ . '_' . $yy?>"> </i >  </div>
		
		<?php
			if($xx >= 7){
				$xx = 0;
			}
			if(($x % 7) == 0){
				$yy--;
			}


		?>
        <?php } ?>

	
    </div>


	<div class="alert result"></div>
	
    <div class="input-class">
        <textarea name="txtdirection" rows="8" cols="50"></textarea>
        <br /><br />
        <input type="button" name="output" value="Output" class="btn" />
    </div>


</body>
<script src="app.js"></script>
</html>