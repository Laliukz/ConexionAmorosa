// let map;
// let marker;

// function initMap() {
//   const defaultLocation = { lat: 0, lng: 0 };
  
//   map = new google.maps.Map(document.getElementById("map"), {
//     center: defaultLocation,
//     zoom: 10,
//   });

//   const input = document.getElementById("ubicacion");
//   const autocomplete = new google.maps.places.Autocomplete(input);

//   autocomplete.addListener("place_changed", () => {
//     const place = autocomplete.getPlace();
//     if (!place.geometry) {
//       alert("No se encontró la ubicación ingresada");
//       return;
//     }

//     // Actualizar el mapa y el marcador con la ubicación seleccionada
//     map.setCenter(place.geometry.location);
//     map.setZoom(15);
//     colocarMarcador(place.geometry.location);
//   });
// }

// function colocarMarcador(position) {
//   // Eliminar el marcador anterior (si existe)
//   if (marker) {
//     marker.setMap(null);
//   }

//   // Crear un nuevo marcador en la posición proporcionada
//   marker = new google.maps.Marker({
//     position: position,
//     map: map,
//   });
// }

// function buscarUbicacion() {
//   const input = document.getElementById("ubicacion").value;
  
//   // Realizar una búsqueda de geocodificación para convertir el texto de ubicación en coordenadas latitud y longitud
//   const geocoder = new google.maps.Geocoder();
//   geocoder.geocode({ address: input }, (results, status) => {
//     if (status === "OK") {
//       const location = results[0].geometry.location;

//       // Actualizar el mapa y el marcador con la ubicación encontrada
//       map.setCenter(location);
//       map.setZoom(15);
//       colocarMarcador(location);
//     } else {
//       alert("No se encontró la ubicación ingresada");
//     }
//   });
// }

//rango km
    const distanciaRange = document.getElementById("dis");
    const distanciaSpan = document.getElementById("pref-dis");
  
    distanciaRange.addEventListener("input", function() {
      const distanciaValue = distanciaRange.value;
      distanciaSpan.textContent = `${distanciaValue} km`;
    });

//rango edad
    const edadRange = document.getElementById("edad");
    const edadSpan = document.getElementById("18");
  
    edadRange.addEventListener("input", function() {
      const edadValue = edadRange.value;
      edadSpan.textContent = ` ${edadValue} años` ;
    });
  