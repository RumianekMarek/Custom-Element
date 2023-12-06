<?php 
if ($color != '#000000'){
    $color = '#ffffff';
}
?>

<style>
.custom_element_<?php echo $rnd_id ?> .pytanie-odpowiedz{
    max-width: 750px; 
    border-bottom: 1px solid <?php echo $color ?>;
}
.custom_element_<?php echo $rnd_id ?> .custom-container-faq h4 {
        padding: 0 10px 5px 0;
        box-shadow: 9px 9px 0px -6px <?php echo $color ?>;
    }
.pytanie::after{
    content: ">";
    float: right;
    top: 50%;
    transform: rotate(0);
    transition: transform 200ms ease-out;
}
.active.pytanie::after{
    transform: rotate(90deg);
}
.pytanie{
    cursor:pointer;
}
.odpowiedz{
    padding-top: 0px !important;
    margin-left: 20px;
    display: none;
}
.custom_element_<?php echo $rnd_id ?>  #faq :is(.pytanie, .odpowiedz, a, h4){
    color: <?php echo $color ?>
}
</style>

<div id="faq" class="custom-container-faq style-accent-bg custom-align-left">
    <div class="heading-text el-text half-block-padding">
        <?php if($locale == 'pl_PL'){
            echo '<h4>Poznaj odpowiedzi na najczęściej zadawane pytania</h4>';
        } else {  
            echo '<h4>Get answers to the most frequently asked questions</h4>';
        } ?>
    </div>
    
    <div class="container-pytan half-block-padding link-text-underline">
    <?php if($locale == 'pl_PL'){ echo '
        <div class="pytanie-odpowiedz pytanie-odpowiedz-1">
            <div class="pytanie half-block-padding">Gdzie odbywają się targi?</div>
            <div class="odpowiedz half-block-padding">Targi odbywają się w <a style="text-decoration:underline;" href="//warsawexpo.eu">Ptak Warsaw Expo</a>, Al. Katowicka 62, 05-830 Nadarzyn</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-2">
            <div class="pytanie half-block-padding">W jakich godzinach odbywają się targi?</div>
            <div class="odpowiedz half-block-padding">Godziny otwarcia targów - 10:00 - 17:00.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-3">
            <div class="pytanie half-block-padding">Ile kosztuje bilet na targi?</div>
            <div class="odpowiedz half-block-padding">Bilety będą dostępne w przedsprzedaży internetowej oraz na miejscu w recepcjach podczas trwania targów. Wszystkie osoby, które dokonają rejestracji online lub w biurze targowym otrzymają bezpłatną wejściówkę wyłącznie na dni branżowe.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-4">
            <div class="pytanie half-block-padding">Czy moje zaproszenie uprawnia mnie do wejścia na targi?</div>
            <div class="odpowiedz half-block-padding">Zaproszenie ma tylko formę informacyjną i nie upoważnia do wejścia na targi. Konieczna jest rejestracja lub zakup biletu.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-5">
            <div class="pytanie half-block-padding">Czy mogę wejść z dzieckiem na targi?</div>
            <div class="odpowiedz half-block-padding">Wstęp dla dzieci jest niewskazany. Jednak jeśli chcesz aby Twoje dziecko towarzyszyło Ci podczas targów to zakup dla niego bilet na dany dzień. Wstęp na targi dla dzieci do 7 roku życia jest bezpłatny.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-6">
            <div class="pytanie half-block-padding">Czy na targi dozwolone jest wprowadzanie zwierząt?</div>
            <div class="odpowiedz half-block-padding">Nie, zwierzęta nie są wpuszczane na hale targowe.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-7">
            <div class="pytanie half-block-padding">Jak dotrzeć na targi?</div>
            <div class="odpowiedz half-block-padding">Na targi można dotrzeć samochodem lub autobusami linii 703 oraz 711 dojeżdżającymi z przystanku P+R Al. Krakowska 15 do Ptak Warsaw Expo.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-8">
            <div class="pytanie half-block-padding">Czy parking jest płatny?</div>
            <div class="odpowiedz half-block-padding">Dla wygody odwiedzających nas gości parking jest bezpłatny.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-9">
            <div class="pytanie half-block-padding">Czy mogę coś zjeść na miejscu?</div>
            <div class="odpowiedz half-block-padding">Tak, na terenie targów będą punkty gastronomiczne.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-10">
            <div class="pytanie half-block-padding">Czy jest dostępna szatnia? Czy mogę zostawić walizkę w szatni?</div>
            <div class="odpowiedz half-block-padding">Tak. Na terenie hal znajdują się szatnie i będzie można zostawić w nich małą walizkę.</div>
        </div> ';
    } else { echo '
        <div class="pytanie-odpowiedz pytanie-odpowiedz-1">
            <div class="pytanie half-block-padding">Where are the fairs held?</div>
            <div class="odpowiedz half-block-padding">The fair takes place at <a style=" text-decoration:underline;" href="//warsawexpo.eu/en/"> Ptak Warsaw Expo </a>, Al. Katowicka 62, 05-830 Nadarzyn, 114D Wolica*</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-2">
            <div class="pytanie half-block-padding">What hours are the fairs held?</div>
            <div class="odpowiedz half-block-padding">Fair opening hours - 10:00 - 17:00.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-3">
            <div class="pytanie half-block-padding">How much is the ticket to the fair?</div>
            <div class="odpowiedz half-block-padding">Tickets will be available in online pre-sale and at the reception desks during the fair. All persons who register online or at the fair office will receive a free pass only for industry days.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-4">
            <div class="pytanie half-block-padding">Does my invitation entitle me to enter the fair?</div>
            <div class="odpowiedz half-block-padding">The invitation is for information purposes only and does not entitle you to enter the fair. It is necessary to register or purchase a ticket.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-5">
            <div class="pytanie half-block-padding">Can I enter the fair with my child?</div>
            <div class="odpowiedz half-block-padding">Admission for children is not recommended. However, if you want your child to accompany you during the fair, buy for him a ticket for the day. Admission to the fair for children under 7 is free.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-6">
            <div class="pytanie half-block-padding">Are animals allowed at the fair?</div>
            <div class="odpowiedz half-block-padding">No, animals are not allowed in the exhibition halls.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-7">
            <div class="pytanie half-block-padding">How to get to the fair?</div>
            <div class="odpowiedz half-block-padding">The fair can be reached by car or by buses 703 and 711 from P + R Al. Krakowska 15 to Ptak Warsaw Expo.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-8">
            <div class="pytanie half-block-padding">Is parking paid?</div>
            <div class="odpowiedz half-block-padding">For the convenience of our guests, the car park is free of charge.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-9">
            <div class="pytanie half-block-padding">Can I eat something on the spot?</div>
            <div class="odpowiedz half-block-padding">Yes, there will be food outlets at the fairgrounds.</div>
        </div>
        <div class="pytanie-odpowiedz pytanie-odpowiedz-10">
            <div class="pytanie half-block-padding">Is there a cloakroom available? Can I leave my suitcase in the cloakroom?</div>
            <div class="odpowiedz half-block-padding">Yes. There are cloakrooms in the halls and you will be able to leave a small suitcase in them.</div>
        </div> ';
    } ?>
    </div>
</div>