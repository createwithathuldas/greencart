<?php
include("../Connection/connection.php");

session_start();

$searchName = $_GET['searchName'];

$selQuery = "select * from tbl_plant p 
inner join tbl_plant_category c 
on p.plant_category_id = c.plant_category_id 
left join tbl_shop s on s.shop_id = p.shop_id 
where p.plant_name like '$searchName%' 
or c.plant_category_name 
like '$searchName%' or s.shop_name like '$searchName%'";

if ($searchName != "" || $searchName != null) {
    $_SESSION['sel_query'] = $selQuery;
    $_SESSION['search_name'] = $searchName;
} else {
    unset($_SESSION['sel_query']);
    unset($_SESSION['search_name']);
}

?>
<!-- </div> -->
<!-- view plant -->