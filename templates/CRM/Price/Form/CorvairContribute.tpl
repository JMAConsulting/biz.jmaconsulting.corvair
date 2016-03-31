{literal}
<script type="text/javascript">
cj(function( ) {
{/literal}
{if $contributionPageID eq 1}
   cj('div.custom_pre_profile-group').insertBefore(cj('div#membership').parent());
   cj('div.email-5-section').insertBefore(cj('div#membership').parent());
{/if}
{literal}
    cj('#priceset div .membership_amount-content .price-set-row').each(function( index ) {
      cj(this).attr('id', 'corvair_' + (index + 1));
    });

    cj("#country-1" ).change(function( ) {
                switch( cj("#country-1").val() ) {
                case '1228':
                cj("#corvair_1").show();
                cj("#corvair_2").show();
                cj("#corvair_3").hide();
                cj("#corvair_4").hide();
                cj("#corvair_5").hide();
                cj("#corvair_6").hide();
                break;
                case '1039':
                cj("#corvair_1").hide();
                cj("#corvair_2").hide();
                cj("#corvair_3").show();
                cj("#corvair_4").show();
                cj("#corvair_5").hide();
                cj("#corvair_6").hide();
                break;
        default:
                cj("#corvair_1").hide();
                cj("#corvair_2").hide();
                cj("#corvair_3").hide();
                cj("#corvair_4").hide();
                cj("#corvair_5").show();
                cj("#corvair_6 ").show();
                break;
                }
      });
    cj('#country-1').change();
});
{/literal}
</script>
