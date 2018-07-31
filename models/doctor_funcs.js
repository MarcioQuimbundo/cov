// JavaScript Document
function searchspecialisation()
{	
var specialisation=document.getElementById('specialisation').value;
 $('#specialisation').autocomplete('doctor/enquire_specialisation.php?specialisation='+specialisation, {
        selectFirst: true
  }); 
}
function searchlocation()
{	
var location=document.getElementById('location').value;
 $('#location').autocomplete('doctor/enquire_location.php?location='+location, {
        selectFirst: true
  }); 
}

