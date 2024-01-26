<?php 
if ($color != '#000000'){
    $color = '#ffffff !important';
}
?>
<style>
    .custom_element_<?php echo $rnd_id ?> .custom-container-grupy :is(h4, p , a){
        color: <?php echo $color ?>
    }
    .custom_element_<?php echo $rnd_id ?> .custom-container-grupy h4 {
        padding: 0 10px 5px 0;
        box-shadow: 9px 9px 0px -6px <?php echo $color ?>;
    }
    .custom-container-grupy a{
        text-decoration: underline;
    }
</style>
<div class="custom-container-grupy style-accent-bg shadow-black single-block-padding">
    <div class="heading-text el-text text-uppercase">
        <h4>
            <?php if($locale == 'pl_PL'){ echo '
            Kontakt dla grup zorganizowanych
            ';} else { echo '
            Contact for organized groups
            ';} ?>
        </h4>
    </div>

    <div>
        <p>
        <?php if($locale == 'pl_PL'){ echo '
            W celu zapewnienia państwu komfortowego udziału w naszych wydarzeniach, wstęp dla grup zorganizowanych możliwy jest tylko ostatniego dnia targowego. Przed wcześniejszym przybyciem zachęcamy do kontaktu przez formularz dostępny na stronie: <a href="https://warsawexpo.eu/grupy"alt="link do rejestracji grup zorganizowanych" target="_blank" style="color:'.$color.'">warsawexpo.eu/grupy</a>.
            Pozostawienie plecaków oraz walizek w szatni jest obligatoryjne.
            Na targach obowiązuje business dress code.
        ';} else { echo '
            To ensure your comfortable participation in our events, admission for organized groups is only possible on the last day of the fair. Before your arrival, we encourage you to contact us through the form available on the website:  <a href="https://warsawexpo.eu/en/groups" alt="link to group registration" target="_blank" style="color:'.$color.'">warsawexpo.eu/en/groups</a>.
            Leaving backpacks and suitcases in the cloakroom is mandatory.
            A business dress code is required at the fair.
        ';} ?>
        </p>   
    </div>
</div>
