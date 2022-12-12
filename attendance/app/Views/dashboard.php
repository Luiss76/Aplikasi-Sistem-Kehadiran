<!-- Begin Page Content -->
<style>
.leaflet-container {
	height: 320px;
	max-width: 100%;
	max-height: 100%;
}
</style>
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>
	<!-- Content Row -->
	<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-4 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pegawai</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tpegawai) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-building fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-4 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Departemen</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tdept) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-building fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pending Requests Card Example -->
		<div class="col-xl-4 col-md-4 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Branch</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tlokasi) ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-building fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Content Row -->
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<div
					class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Lokasi Branch</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div id="map"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script type="text/javascript">
var locations = <?php echo json_encode($markers,JSON_NUMERIC_CHECK);?>;
const map = L.map('map').setView([-0.6300425,121.9169546], 4);
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

for (var i = 0; i < locations.length; i++) {
  const marker = new L.marker([locations[i].latitude, locations[i].longitude]).bindPopup(locations[i].nama).addTo(map);
}
</script>