<!-- Default box -->
<div class="row">

	<!-- Nasabah -->

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h4>NASABAH</h4>
	</div>

	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fas fa-mobile"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Nasabah Terdaftar</span>
				<span class="info-box-number"><?= rupiah($nsb['nasabah']) ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					Nasabah telah mendaftar
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-green">
			<span class="info-box-icon"><i class="fa fa-laptop"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Deposit</span>
				<span class="info-box-number">IDR <?= rupiah($nsb['deposit']) ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					Deposit Approved
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box bg-yellow">
			<span class="info-box-icon"><i class="fa fa-laptop"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Withdraw</span>
				<span class="info-box-number">IDR <?= rupiah($nsb['withdrawal']) ?></span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					Withdraw Approved
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->

	<div class="col-md-12">
		<!-- BAR CHART -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Chart Omset & Withdrawal Bulanan Tahun <?= date('Y') ?></h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body chart-responsive">
				<div class="chart" id="chart_omset_wd" style="height: 300px;"></div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>


</div>


<div class="row">

	<!-- Mitra -->

	<div class="col-md-12 col-sm-12 col-xs-12">
		<h4>MITRA</h4>
	</div>

	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Sales Person</span>
				<span class="info-box-number"><?= $mkt['mitra'] ?> orang</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Hot Prospek</span>
				<span class="info-box-number"><?= $mkt['hot_prospek'] ?> orang</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-xs-12">
		<div class="info-box">
			<span class="info-box-icon bg-purple"><i class="fa fa-sign-out"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Allowance Terbayar</span>
				<span class="info-box-number">IDR <?= rupiah($mkt['withdrawal']) ?></span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->


	<div class="col-md-12">
		<!-- LINE CHART -->
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Chart Allowance & Komisi Bulanan Tahun <?= date('Y') ?></h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body chart-responsive">
				<div class="chart" id="chart_allowance" style="height: 300px;"></div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>

</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {


		// Chart Omset & WD
		var bar = new Morris.Bar({
			element: 'chart_omset_wd',
			resize: true,
			data: <?= $chart['omset_wd'] ?>,
			barColors: ['#00a65a', '#f56954'],
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['DEPOSIT', 'WITHDRAWAL'],
			hideHover: 'auto'
		});

		// Chart Allowance & Komisi
		var line = new Morris.Line({
			element: 'chart_allowance',
			resize: true,
			data: <?= $chart['allowance'] ?>,
			xkey: 'y',
			ykeys: ['a', 'b'],
			labels: ['ALLOWANCE', 'KOMISI'],
			lineColors: ['#3c8dbc', '#00a65a'],
			hideHover: 'auto'
		});

	});
</script>