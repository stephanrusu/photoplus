<?php
	require_once('config/config.php');	
	error_reporting(0);
	
	// the table name
	$tableName = "project";	

	// this is the page which should be targeted. If you call this script
	// on a page named about.php then 'about.php' should be the target page
	$targetpage = "index.php"; 	
	
	// How many records you want to show on each page
	$limit = 3; 
	
	$author = $_SESSION['user_id'];

	try {
		$dbConnection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER, DB_PASS);        
	    $query_all = $dbConnection->prepare("SELECT unique_id FROM $tableName WHERE author_id = :author");
	    $query_all->bindValue(':author', $author, PDO::PARAM_INT);
		$query_all->execute();
		$results = $query_all->fetchAll(PDO::FETCH_ASSOC);
		$total_pages = count($results);
	} catch(PDOException $e) {
	    echo "An Error occured!"; //user friendly message
	    echo $e->getMessage();
	}
	
	$stages = 3;
	$page = htmlentities($_GET['page']);
	if($page) {
		$start = ($page - 1) * $limit; 
	} 
	else {
		$start = 0;	
	}	
	
    // Get page data
    try {
		$query_limit = $dbConnection->prepare("SELECT * FROM $tableName WHERE author_id = :author LIMIT $start, $limit");
		$query_limit->bindValue(':author', $author, PDO::PARAM_INT);
		$query_limit->execute();
		//$result = $query_limit->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
	    echo "An Error occured!"; //user friendly message
	    echo $e->getMessage();
	}
	// Initial page num setup
	if ($page == 0)
		{ $page = 1; }
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	$firstpage = 1;
	$firstpagem1 = $firstpage + 1;
	$paginate = '';
	if($lastpage > 1) {	
		
	$paginate .= "<ul class='pagination pagination-sm'>";
	// Previous
	if ($page > 1){
		$paginate.= "<li><a href='$targetpage?page=$firstpage'><i class='fa fa-backward fa-fw'></i> First</a></li>";
		$paginate.= "<li><a href='$targetpage?page=$prev'><i class='fa fa-chevron-left fa-fw'></i> Previous</a></li>";
	}
	else{
		$paginate.= "<li class='disabled'><a href='javascript:void(0);'><i class='fa fa-backward fa-fw'></i> First</a></li>";
		$paginate.= "<li class='disabled'><a href='javascript:void(0);'><i class='fa fa-chevron-left fa-fw'></i> Previous</a></li>";	}
			

		 
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<li class='active'><span>$counter</span></li>";
				}else{
					$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><span>$counter</span></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
				$paginate.= "<li><a href='#'>...</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<li><a href='$targetpage?page=$firstpage'>$firstpage</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$firstpage+1'>$firstpagem1</a></li>";
				$paginate.= "<li><a href='#'>...</a></li>";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><span>$counter</span></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
				$paginate.= "<li><a href='#'>...</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<li><a href='$targetpage?page=$firstpage'>$firstpage</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$firstpage'>$firstpagem1</a></li>";
				$paginate.= "<li><a href='#'>...</a>";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><span>$counter</span></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
			}
		}
				
			// Next
		if ($page < $counter - 1){ 
			$paginate.= "<li><a href='$targetpage?page=$next'>Next <i class='fa fa-chevron-right fa-fw'></i></a></li>";
			$paginate.= "<li><a href='$targetpage?page=$lastpage'>Last <i class='fa fa-forward fa-fw'></i></a></li>";			
		}else{
			$paginate.= "<li class='disabled'><a href='javascript:void(0);'>Next <i class='fa fa-chevron-right fa-fw'></i></a></li>";
			$paginate.= "<li class='disabled'><a href='javascript:void(0);'>Last <i class='fa fa-forward fa-fw'></i></a></li>";			
			}
			
		$paginate.= "</ul>";
	
	
	}
?>