<?php
include("connexion.php");
$debut=$_POST['checkin'];
$fin=$_POST['checkout'];

$date1 = strtotime($debut);
$date2 = strtotime($fin);
$nb_jours_timestamp = $date2-$date1;
$nb_jours= $nb_jours_timestamp/86400;

if(!empty($debut) && !empty($debut)){
    header("location:../pages/reservation2.php?db=".$debut."&fn=".$fin."&nb_jours=".$nb_jours);
}
?>