<style>
    #calendar-add :is(.bigtext-line0, h2, h3){
        color:white !important;
        text-shadow: 2px 2px black;
        font-weight:700;
    }
    .row-container:has(.custom-container-calendar-add){
    background-image: url(/doc/background.jpg);
    background-size: 100% 60%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    }
    .custom-calendar-add-header{
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 50px;
    }
    .custom-calendar-add-header img{
        max-width:400px;
    }
    .custom-container-calendar-icons{
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        gap:10px;
        margin-top: 20px;
    }
    .custom-header-calendar-add{
        max-width:700px;
    }
    .custom-container-calendar-icons a{
        background: white;
        padding:5px 0;
    }
    .custom-container-calendar-icons p{
        color:black;
        margin:5px;
        line-height: 1.2;
    }
    .custom-container-calendar-icons img{
        max-width: 150px
    }
    /* all */
    .custom-shadow-black{
        box-shadow: 9px 9px 0px -5px black;
        border: 2px solid black;
    }
</style>

<div id='calendar-add' class='custom-container-calendar-add text-centered'>
    <div class='custom-calendar-add-header'>
        <div class='custom-calendar-add-header-logo' style="flex:1">
            <img src="/doc/logo.png" alt="logo [trade_fair_name]">
        </div>
        <div class='custom-calendar-add-header-text' style="flex:1">
            <h2> [trade_fair_date]</h2>
            <h2> [trade_fair_desc]</h2>
        </div>
    </div>
    <div class='custom-header-calendar-add text-centered bigtext pl_PL'>
        <h1 class="bigtext-line0 text-uppercase">Dodaj do kalendarza</h1>
    </div> 
    <div class='custom-header-calendar-add text-centered en_US'>
        <h1 class="bigtext-line0 text-uppercase">Add to calendar</h1>
    </div>

    <div class='custom-text-calendar-add text-centered pl_PL'>
        <h3>Wybierz ikonę swojej poczty aby dodać wydarzenie do kalendarza.</h4>
    </div>
    <div class='custom-text-calendar-add text-centered en_US'>
        <h3>Select your mail icon to add the event to your calendar.</h4>
    </div>

    <div class='custom-container-calendar-icons text-centered'>
        <a class='google custom-shadow-black' alt="link do kalendarza google" href='#'><img src="/wp-content/plugins/custom-element/my-custom-element/media/googlecalendar.png"/><p class='font-weight-700'>Kalendarz Google</p></a>
        <a class='outlook custom-shadow-black' alt="link do kalendarza outlook" href='#'><img src="/wp-content/plugins/custom-element/my-custom-element/media/outlook.png"/><p class='font-weight-700'>Microsoft Outlook</p></a>
        <a class='office custom-shadow-black' alt="link do kalendarza office" href='#'><img src="/wp-content/plugins/custom-element/my-custom-element/media/office365.png"/><p class='font-weight-700'>Office 365</p></a>
        <a class='yahoo custom-shadow-black' alt="link do kalendarza yahoo" href='#'><img src="/wp-content/plugins/custom-element/my-custom-element/media/yahoo.png"/><p class='font-weight-700'>Kalendarz Yahoo</p></a>
        <a class='apple custom-shadow-black' alt="link do kalendarza apple" href='#' onclick="generujPlikKalendarza(); return false;"><img src="/wp-content/plugins/custom-element/my-custom-element/media/apple.png"/><p class='font-weight-700'>Kalendarz Apple</p></a>
    </div>
</div>

<script type="text/javascript">
var start = '[trade_fair_datetotimer]';
var end = '[trade_fair_enddata]';
var name = '[trade_fair_name]'.replace(/ /g, '%20').replace(/&/g, 'and');
var desc = '[trade_fair_desc]'.replace(/ /g, '%20').replace(/&/g, 'and');

var glink = 'https://calendar.google.com/calendar/render?action=TEMPLATE&details='+desc+'&dates='+start.substring(0,4)+start.substring(5,7)+start.substring(8,10)+'T100000%2F'+end.substring(0,4)+end.substring(5,7)+end.substring(8,10)+'T170000?0&location=Aleja%20Katowicka%2062%2C%2005-Al.%20Katowicka%2062%2C%2005-830%20Nadarzyn%2C%20Polska&text='+name;
document.querySelector('.google').href = glink;

var olink = 'https://outlook.live.com/calendar/0/deeplink/compose?allday=false&body='+desc+'&enddt='+end.substring(0,4)+'-'+end.substring(5,7)+'-'+end.substring(8,10)+'T17%3A00%3A00%3A00&location=Al.%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+start.substring(0,4)+'-'+start.substring(5,7)+'-'+start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+name;
document.querySelector('.outlook').href = olink; 

var flink = 'https://outlook.office.com/calendar/0/deeplink/compose?allday=false&body='+desc+'&enddt='+end.substring(0,4)+'-'+end.substring(5,7)+'-'+end.substring(8,10)+'T17%3A00%3A00%3A00&location=Al.%20Katowicka%2062%2C%2005-830%20Nadarzyn&path=%2Fcalendar%2Faction%2Fcompose&rru=addevent&startdt='+start.substring(0,4)+'-'+start.substring(5,7)+'-'+start.substring(8,10)+'T10%3A00%3A00%3A00&subject='+name;
document.querySelector('.office').href = flink;
console.log(flink) 

var ylink = 'https://calendar.yahoo.com/?desc='+desc+'&dur=&et='+end.substring(0,4)+end.substring(5,7)+end.substring(8,10)+'T170000&in_loc=Al.%20Katowicka%2062%2C%2005-830%20Nadarzyn&st='+start.substring(0,4)+start.substring(5,7)+start.substring(8,10)+'T100000&title='+name+'&v=60';
document.querySelector('.yahoo').href = ylink; 

const generujPlikKalendarza = () => {
    var start = '[trade_fair_datetotimer]';
    var end = '[trade_fair_enddata]';
 
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/wp-content/plugins/custom-element/my-custom-element/callendarApple.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.getAllResponseHeaders());
        console.log(xhr.responseText);
        }
    };
    xhr.send('start=' + start + '&end=' + end);
}

</script>