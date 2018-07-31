// JavaScript Document
function searchVendor()
{
 $("#vendor_name").autocomplete({ source : 'vendor/enquire_vendor.php', minLength: 1 }); 
}
function searchItems()
{
 $("#item_name").autocomplete({ source : 'vendor/enquire_items.php', minLength: 1 }); 
}
function searchVendor()
{
 $("#p_vendor_name").autocomplete({ source : 'vendor/enquire_p_vendor.php', minLength: 1 }); 
}
function searchItems()
{
 $("#p_item_name").autocomplete({ source : 'vendor/enquire_p_items.php', minLength: 1 }); 
}