@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.0.0/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
@endsection

@section('content')
	<div class="container">
		<h1 class="text-center mt-4">Registrar Establecimientos</h1>

		<div class="mt-5 row justify-content-center">
			<form class="col-md-9 col-xs-12 card card-body">
				<fieldset class="border p-4">
					<legend class="text-primary">
						Nombre, Categoría e imagen
					</legend>

					<div class="form-group">
						<label for="nombre">Nombre Establecimiento</label>
						<input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre del establecimiento" name="nombre" value="{{ old('nombre') }}">

						@error('nombre')
							<div class="invalid-feedback">
								{{$message}}
							</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="categoria">Categoría</label>
						<select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria">
							<option value="" selected disabled>-- Seleccione --</option>

							@foreach ($categorias as $categoria)
								<option value="{{$categoria->id}}" {{ old('categoria_id') == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
							@endforeach
						</select>

						@error('categoria_id')
							<div class="invalid-feedback">
								{{$message}}
							</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="imagen_principal">Imagen principal</label>
						<input type="file" id="imagen_principal" class="form-control @error('imagen_principal') is-invalid @enderror" name="imagen_principal" value="{{ old('imagen_principal') }}">

						@error('imagen_principal')
							<div class="invalid-feedback">
								{{$message}}
							</div>
						@enderror
					</div>
				</fieldset>

				<fieldset class="border p-4">
					<legend class="text-primary">
						Ubicación
					</legend>

					<div class="form-group">
						<label for="formbuscador">Coloca la dirección del Establecimiento</label>
						<input type="text" id="formbuscador" placeholder="Calle del establecimiento" class="form-control">

						<p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una dirección estimada o  mueve el Pin hacia el lugar correcto</p>
					</div>

					<div class="form-group">
						<div id="mapa" style="height: 400px;"></div>
					</div>

					<p class="informacion">Confirma que los siguientes campos son correctos</p>

					<div class="form-group">
						<label for="direccion">Dirección</label>

						<input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" placeholder="Direccion" value="{{ old('direccion') }}">

						@error('direccion')
							<div class="invalid-feedback">
								{{$message}}
							</div>
						@enderror
					</div>

					<div class="form-group">
						<label for="colonia">Colonia</label>

						<input type="text" name="colonia" id="colonia" class="form-control @error('colonia') is-invalid @enderror" placeholder="Colonia" value="{{ old('colonia') }}">

						@error('colonia')
							<div class="invalid-feedback">
								{{$message}}
							</div>
						@enderror
					</div>

					<input type="hidden" id="lat" name="lat" value="{{ old('lat')}}">
					<input type="hidden" id="lng" name="lng" value="{{ old('lng')}}">

				</fieldset>

			</form>
		</div>
	</div>

@endsection

@section('scripts')
	 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <script src="https://unpkg.com/esri-leaflet@3.0.2/dist/esri-leaflet.js"
    integrity="sha512-myckXhaJsP7Q7MZva03Tfme/MSF5a6HC2xryjAM4FxPLHGqlh5VALCbywHnzs2uPoF/4G/QVXyYDDSkp5nPfig=="
    crossorigin=""></script> 

	<script src="https://unpkg.com/esri-leaflet-geocoder@3.0.0/dist/esri-leaflet-geocoder.js"
    integrity="sha512-vZbMwAf1/rpBExyV27ey3zAEwxelsO4Nf+mfT7s6VTJPUbYmD2KSuTRXTxOFhIYqhajaBU+X5PuFK1QJ1U9Myg=="
    crossorigin=""></script>
@endsection