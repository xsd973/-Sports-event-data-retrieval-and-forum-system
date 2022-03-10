<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();

$query = "select * from teamstatistic";
$result=execute($link,$query);

while($data=mysqli_fetch_assoc($result)){
    $data['shots'] = round($data['shots'],1);
    $data['possession'] = round($data['possession']*100,1);
    $data['passSucc'] = round($data['passSucc']*100,1);
    $data['aerialWon'] = round($data['aerialWon'],1);
    $data['rate'] = round($data['rate'],2);
    $list[] = array($data['id'],$data['teamName'],$data['competitionName'],$data['shots'],$data['yelCards'],$data['redCards'],$data['possession'],
    $data['passSucc'],$data['bigChanceCreated'],$data['aerialWon'],$data['rate']);
};
echo json_encode($list);
?>