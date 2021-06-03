import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {
	if(document.querySelector('#mapa')){
		
		const lat = document.querySelector('#lat').value === '' ? 20.666332695977 : document.querySelector('#lat').value;
	    const lng = document.querySelector('#lng').value === '' ? -103.392177745699 : document.querySelector('#lng').value;

	    const mapa = L.map('mapa').setView([lat, lng], 16);

	    //eliminar pines previos
	    let markers = new L.FeatureGroup().addTo(mapa);

	    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	    }).addTo(mapa);
	 
	    let marker;

	    // agregar el pin
	    marker = new L.marker([lat, lng], {
	    	draggable: true,
	    	autoPan: true
	    }).addTo(mapa);

	    //agregar el pin a las capas
	    markers.addLayer(marker);

	    //geocode service
	    const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPK22263b54e6cd49cb86e23f2d29001bf1nvmGQNwGCJmDbXuLuWwXRCqGLtvi3H1fx2ielpPdRITrVtdeHSKevTSe9YbrdU_8' // reemplazamos con nuestra api key de https://developers.arcgis.com 
        });

        //buscador de direcciones
        const buscador = document.querySelector('#formdireccion');
        buscador.addEventListener('blur', buscarDireccion);

	    reubicarPin(marker);

	    function reubicarPin(marker) {
	    	//detectar movimiento del marker
	    	marker.on('moveend', function(e) {
		    	marker = e.target;

		    	const posicion = marker.getLatLng();

		    	//centrar automaticamente
		    	mapa.panTo( new L.LatLng(posicion.lat, posicion.lng) );

		    	//reverse geocoding cuando el usuario reubica el pin
		    	geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado) {
		    			//console.log(error);

		    			console.log(resultado.address);

		    			marker.bindPopup(resultado.address.LongLabel);
		    			marker.openPopup();

		    			//llenar los campos
		    			llenarInputs(resultado);
	    		}); 

	    	});
	    }

	    function buscarDireccion() {
	    	if(e.target.value.length > 10) {
	    		provider.search({ query: e.target.value + ' Guadalajara MX' })
	    			.then( resultado => {
	    				if(resultado ) {
	    					//limpiar pines previos
	    					markers.clearLayers();

	    					//reverse geocoding cuando el usuario reubica el pin
				    		geocodeService.reverse().latlng(resultado[0].bounds[0], 16).run(function(error, resultado) {

				    			//llenar inputs
				    			llenarInputs(resultado);
				    			//centrar mapa
				    			mapa.setView(resultado.latlng)
				    			//agregar pin
				    			marker = new L.marker(resultado.latlng, {
							    	draggable: true,
							    	autoPan: true
							    }).addTo(mapa);
							    //asignar al contenedor el nuevo pin
							    markers.addLayer(marker);
				    			//mover pin
				    			reubicarPin(marker);

	    					});
				    	}
	    			})
	    			.catch( error => {
	    				console.log(error);
	    			})
	    	}
	    }

	    function llenarInputs(resultado) {
			document.querySelector('#direccion').value = resultado.address.Address || '';
			document.querySelector('#colonia').value = resultado.address.Neighborhood || '';
			document.querySelector('#lat').value = resultado.latlng.lat || '';
			document.querySelector('#lng').value = resultado.latlng.lng || '';
    	}
	}
  		
}); 
  	