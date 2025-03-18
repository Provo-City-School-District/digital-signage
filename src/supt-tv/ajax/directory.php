<?php
	$htmlContent = file_get_contents("http://158.91.5.50:8082/directory/");

	$DOM = new DOMDocument();
	$DOM->loadHTML($htmlContent);

	$Header = $DOM->getElementsByTagName('th');
	$Detail = $DOM->getElementsByTagName('td');

    //#Get header name of the table
	foreach($Header as $NodeHeader)
	{
		$aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
	}
	//print_r($aDataTableHeaderHTML); die();

	//#Get row data/detail table without header name as key
	$i = 0;
	$j = 0;
	foreach($Detail as $sNodeDetail)
	{
		$aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
		$i = $i + 1;
		$j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
	}
	//print_r($aDataTableDetailHTML); die();

	//#Get row data/detail table with header name as key and outer array index as row number
	for($i = 0; $i < count($aDataTableDetailHTML); $i++)
	{
		for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
		{
			$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
		}
	}
	$aDataTableDetailHTML = $aTempData; unset($aTempData);
	//print_r($aDataTableDetailHTML); die();

	//print_r($pvCard);
	//##Will display the arrays
	//print_r($aDataTableDetailHTML);
	/*
	Key
	[0] => Array
        (
            [Technician] => JP  Pontious
            [Title] => Network Systems Administrator
            [Room Number] => Rm 4B
            [Current Location] => Aux Services
            [Message] =>
            [Today's Schedule] => 07:30 AM to 04:30 PM   (M-F)
        )
     */
$countStaff = count($aDataTableDetailHTML);
$staffCounter = 0;
while( $staffCounter < $countStaff) {
	$imageFilename = str_replace(' ', '', 'staff-images/'.$aDataTableDetailHTML[$staffCounter]['Technician'].'.jpg');
?>
<div class="post personalvCard">

				<ul>
					<li class="name"><strong><?php echo $aDataTableDetailHTML[$staffCounter]['Technician']; ?></strong></li>
				
					<li class="title"><?php echo $aDataTableDetailHTML[$staffCounter]['Title']; ?></li>
					<li class="schedule">Schedule: <?php echo $aDataTableDetailHTML[$staffCounter]["Today's Schedule"]; ?></li>
						<img class="staff-member-photo" src="<?php
							if(file_exists($imageFilename)) {
								echo str_replace(' ', '', 'http://158.91.1.117/ajax/staff-images/'.$aDataTableDetailHTML[$staffCounter]['Technician'].'.jpg');
							} else {
								echo 'http://158.91.1.117/ajax/staff-images/placeholder.jpg';
							}
						?>"
						alt="<?php echo $aDataTableDetailHTML[$staffCounter]['Technician']; ?>">
					<li class="rm">Office: <?php echo $aDataTableDetailHTML[$staffCounter]['Room Number']; ?></li>
					<li class="currentGPS"><strong>Current Location: <br><?php echo $aDataTableDetailHTML[$staffCounter]['Current Location']; ?></strong></li>
					<li class="vaultmessage"><?php if($aDataTableDetailHTML[$staffCounter]['Message']) {echo 'Note: '.$aDataTableDetailHTML[$staffCounter]['Message'];} ?></li>


				</ul>
		</div> <?php
		$staffCounter++;
} ?>