<html>
	<head>
		<title>Tip Calculator</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<form method="POST">
			<div id="calc">
				<h1>Tip Calculator</h1>
				<div id="bill">
					Bill Subtotal: $ 
					<input type="text" name="bill" value=
						<?php 
							// re populate bill subtotal
							function repopulate($v){
								if(is_numeric($v)&&$v>0){
									echo $v;
								}
							}

							repopulate($_POST["bill"]);
						?>
					>
					<?php
						// validate bill input
						function valid_bill($b){
							$bv = false;

							if(empty($b)){
								echo "<p>* Bill subtotal required.</p>";
							}
							else if(!is_numeric($b)){
								echo "<p>* Bill subtotal must be numeric.</p>";
								
							}
							else if($b<0){
								echo "<p>* Bill subtotal must be > 0.</p>";
							}
							else{
								$bv = true;
							}

							return $bv;
						}

						if(valid_bill($_POST["bill"])){
							// set bill
							$bil = $_POST["bill"];
						}
					?>
				</div>
				<br>
				<div id="pct">
					Tip Percentage:
					<br><br>
					<?php  
						// create tip choices

						// create constant tip
						function radio_tip(){
							// 3 via loop
							for($i=10; $i<=20; $i+=5){
								echo "<input type=\"radio\" name=\"pct\" value=$i";
								// re populate radio
								if($_POST["pct"]==$i){
									echo " checked=\"checked\"";
								}
								echo ">$i%";
							}
						}

						radio_tip();
						
						// create custom tip
						function custom_tip(){
							echo "<br>";
							
							// custom radio
							echo "<input type=\"radio\" name=\"pct\"";
							// re populate radio
							if($_POST["pct"]==on){
								echo " checked=\"checked\"";
							}
							echo ">";

							// custom label
							echo "Custom: ";
							// custom text field
							echo "<input type=\"text\" name=\"cst\" value=";
							
							// if valid custom set percent
							if(is_numeric($_POST["cst"])
								&&$_POST["cst"]>0
								&&$_POST["pct"]==on){
								echo $_POST["cst"];
								$_POST["pct"] = $_POST["cst"];
							}

							echo ">";
							echo " %";
						}						
						
						custom_tip();
					?>
					<?php
						// validate tip check
						function valid_tip($p){
							$pv = false;
							if(!isset($p)){
								echo "<p>* Tip percentage must be checked.</p>";
							}
							else if($_POST["pct"]==on){
								if(empty($_POST["cst"])){
									echo "<p>* Tip percentage required.";
								}			
								else if($_POST["cst"]<0||$p<0){
									echo "<p>* Tip percentage must be > 0.</p>";
								}
								else if(!is_numeric($p)){
									echo "<p>* Tip percentage must be numeric.</p>";
								}
							}
							else{
								$pv = true;
							}

							return $pv;
						}

						if(valid_tip($_POST["pct"])){
							// set percent
							$pct = $_POST["pct"];
						}
					?>
				</div>
				<br>
				<div id="split">
					Split:
					<input type="text" name="split" value=
					<?php
						// re populate split
						repopulate($_POST["split"]);
					?>
					> person(s)
					<?php
						// validate split
						function valid_split($s){
							return (is_numeric($s)&&$s>0)? true: false;
						}
							
						if(valid_split($_POST["split"])){
							$split = $_POST["split"];
						}
					?>
				</div>
				<br>
				<div id="submit">
					<input type="submit" name="submit" value="Submit">
					<?php
						if(isset($_POST["submit"])){
							// calculate tip
							$tip = $pct/100*$bil;
							
							// calculate total
							$tot = $bil + $tip;

							// if bill and pct 
							if($bil>0&&isset($pct)){
								echo "<br><br>";
								echo "<div id=\"result\">";

								// show tip
								echo "Tip: \$".number_format($tip,2)."<br>";
								
								// show total
								echo "Total: \$".number_format($tot,2)."<br>";
								
								// show split
								if($split>1){
									echo "Tip each: \$".number_format($tip/$split,2)."<br>";
									echo "Total each: \$".number_format($tot/$split,2)."<br>";
								}

								echo "</div>";
							}
						}
					?>
				</div>
			</div>
		</form>
	</body>
</html>
