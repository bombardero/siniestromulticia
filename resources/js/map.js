 
function iniciarMap(){
    var coord = {lat:-33.8544507 ,lng: -55.4068004};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}