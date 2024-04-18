<?php 
if ($color != '#ffffff'){
    $color = '#000000 !important';
}
?>
<style>
#ptakAdress{
    border: 1px solid black;
    min-height: 270px;
    max-width: 555px;
    margin:auto;
    min-width: 350px;
    display: flex;
    align-items: center;
    justify-content: space-around;
}
.row-container:has(#socialMedia) #ptakAdress {
    max-width: 500px;
}
.custom_element_<?php echo $rnd_id ?>  #ptakAdress li{
    color: <?php echo $color ?>;
}
.custom-text-ptakAdress li {
    font-size:30px !important;
    font-weight: 700;
    color:black;
    line-height: 1.2;
}
@media (max-width: 760px) {
    #ptakAdress, #socialMedia {
        min-width: 260px;
    }
    .custom-text-ptakAdress li {
        font-size:24px !important;
    }
}
</style>
<div id='ptakAdress' class='custom-container-ptakAdress  text-centered drive'>
<ul class='list-style-none custom-text-ptakAdress' style='padding-left:0 !important; margin: 0 !important'>
        <li> Ptak Warsaw Expo </li>
        <li> Al. Katowicka 62, </li>
        <?php if($locale == 'pl_PL'){ echo '
            <li> 05-830 Nadarzyn, Polska </li>
        ';} else { echo '
            <li> 05-830 Nadarzyn, Poland </li>
        ';} ?>
        <li> info@warsawexpo.eu </li>
    </ul>
</div>