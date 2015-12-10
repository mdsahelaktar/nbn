<script type="application/javascript">
function setClientCountry(elm)
{
    var countryId = $(elm).val();
    var method = new Array("POST", "<?php echo site_url("admin/common/ajax") ?>", "method=setclientcountry&country_id=" + countryId, "html", false);
    ajaxAction(method, afterSettingClientCountry);
}
function afterSettingClientCountry(data)
{
    location.reload();
}
function setDefaultCountry(countryId)
{
    var method = new Array("POST", "<?php echo site_url("admin/common/ajax") ?>", "method=setclientcountry&country_id=" + countryId, "html", false);
    ajaxAction(method, afterSettingClientCountry);
}
</script>