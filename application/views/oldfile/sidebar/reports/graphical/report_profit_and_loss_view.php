<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-12 main pl5 pr5" style="margin-top: 55px">
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-toolbar">
    		<a href="<?php echo site_url('reports_con') ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-chevron-left"></span> Back to Reports</a>
    	</div>
    	<div class="panel-title text-center">
        <span class="glyphicon glyphicon-usd"></span> Profit Graphical Report
    	</div>
    	<div class="panel-toolbar"></div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/profit_and_loss/graphical'); ?>" method="get" accept-charset="utf-8" class="col-xs-6 col-xs-offset-3 form-inline pr0 mb15">
		    	<div class="row">
		    		<div class="col-xs-12">
			    		<label for="from" class="pr10 pl10">From: </label>
			    		<div class="input-group">
			    			<input type="text" name="from" id="from" class="form-control input-sm" value="<?php echo $input['from'] ?>">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			    		</div>
			    		<label for="to" class="pl10 pr10">To: </label>
			    		<div class="input-group pr10">
			    			<input type="text" name="to" id="to" class="form-control input-sm" value="<?php echo $input['to'] ?>">
								<span class="input-group-addon "><span class="glyphicon glyphicon-calendar"></span></span>
			    		</div>
			    		<button class="btn btn-default btn-sm">Filter</button>
		    		</div>
		    	</div>
	    	</form>
	    	<style>
		    	.odd td:nth-child(odd){
		    		width: 100px !important;
		    	}

		    	.odd td:nth-child(even){
		    		width: 200px !important;
		    	}
					.label ul {
						margin-bottom: -15px;
						text-align: left;
					}

					.label ul li {
						display: inline;
					  padding-left: 30px;
					  position: relative;
					  margin-bottom: 4px;
					  border-radius: 5px;
					  padding: 2px 50px 2px 28px;
					  font-size: 14px;
					  color: #3F403F !important;
					}

					.label li span {
					  display: block;
					  position: absolute;
					  left: 0;
					  top: 0;
					  width: 20px;
					  height: 100%;
					  border-radius: 5px;
					}
	    	</style>
	    	<div class="col-xs-6 col-xs-offset-3 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Cost of Good</td>
	    				<td class="pa5"><strong class="fsize24">P <?php if(isset($sum)) echo number_format($sum[1], 2) ?></strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Profit</td>
	    				<td class="pa5"><strong class="fsize24">P <?php if(isset($sum)) echo number_format($sum[0], 2) ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>
	    <div class="chart">
		    <div class="label" style="font:black !important"></div>
		   	<div style="width: 100%">
					<canvas id="canvas" height="200" width="600"></canvas>
				</div>
	    </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('public/js/Chart.min.js') ?>"></script>
<script>
	var data = '<?php echo json_encode($result)?>'
	var ctx = $('#canvas').get(0).getContext('2d'),
			myLine = new Chart(ctx).Bar(JSON.parse(data), {
			responsive: true,
			scaleBeginAtZero : true,
	    scaleShowGridLines : true,
	    scaleGridLineColor : "rgba(0,0,0,.05)",
	    scaleGridLineWidth : 1,
	    scaleShowHorizontalLines: true,
	    scaleShowVerticalLines: true,
	    bezierCurve : false,
	    // bezierCurveTension : 0.4,
	    pointDot : true,
	    pointDotRadius : 4,
	    pointDotStrokeWidth : 1,
	    pointHitDetectionRadius : 20,
	    datasetStroke : true,
	    datasetStrokeWidth : 2,
	    datasetFill : true,
	    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

		});

	var legendHolder = myLine.generateLegend();

	$('.label').append(legendHolder);
</script>