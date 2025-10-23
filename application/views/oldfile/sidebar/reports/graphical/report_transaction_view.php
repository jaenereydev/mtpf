<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<div class="col-md-10 main pl0" >
	<div class="panel panel-default">
    <div class="panel-heading" style="padding: 6px 12px;">
    	<div class="panel-title">
        <span class="glyphicon glyphicon-signal"></span> Sales
    	</div>
    </div>
    <div class="panel-body">
	    <div class="row">
	    	<form action="<?php  echo site_url('reports_con/sales/summary'); ?>" method="get" accept-charset="utf-8" class="col-xs-8 col-xs-offset-2 form-inline pr0 mb15">
		    	<div class="row">
		    		<div class="col-xs-12">
			    		<label for="from" class="pr10">From: </label>
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
		    <!-- 	<div class="row pt15">
		    		<div class="col-xs-2 col-xs-offset-10">
	    				<button class="btn btn-default btn-sm">Filter</button>
		    		</div>
		    	</div> -->
	    	</form>
	    	<style>
		    	.odd td:nth-child(odd){
		    		width: 100px !important;
		    	}

		    	.odd td:nth-child(even){
		    		width: 200px !important;
		    	}
					ul {
						margin-bottom: -15px;
						text-align: left;
					}

					ul li {
						display: inline;
					  padding-left: 30px;
					  position: relative;
					  margin-bottom: 4px;
					  border-radius: 5px;
					  padding: 2px 50px 2px 28px;
					  font-size: 14px;
					  color: #3F403F !important;
					}

					li span {
					  display: block;
					  position: absolute;
					  left: 0;
					  top: 0;
					  width: 20px;
					  height: 100%;
					  border-radius: 5px;
					}

				
	    	</style>
	    	<div class="col-xs-12 pt15">
	    		<table class="table table-bordered text-center odd">
	    			<tr>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Credit</td>
	    				<td class="pa5"><strong class="fsize24">P <?php if(isset($result[1][0]->credit)) echo $result[1][0]->credit; else echo "00.00"  ?></strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Check</td>
	    				<td class="pa5"><strong class="fsize24">P <?php if(isset($result[1][0]->checked)) echo $result[1][0]->checked; else echo "00.00" ?></strong></td>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Cash</td>
	    				<td class="pa5"><strong class="fsize24">P <?php if(isset($result[1][0]->cash)) echo $result[1][0]->cash; else echo "00.00" ?></strong></td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-xs-4 col-xs-offset-4">
	    		<table class="table table-bordered text-center">
	    			<tr>
	    				<td width="100px" style="vertical-align: middle" class="pa5">Total Sales</td>
	    				<td class="pa5"><strong class="fsize24">P <?php echo number_format($total, 2, ".", ",") ?></strong></td>
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
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
	var barChartData = {
		labels : ["January","February","March","April","May","June","July","August", "September", "October", "November", "December"],
		datasets : [
			{
			  label: "2015",
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,0.8)",
        highlightFill: "rgba(220,220,220,0.75)",
        highlightStroke: "rgba(220,220,220,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			},
			{
				label: "2014",
        fillColor: "rgba(151,187,205,0.5)",
        strokeColor: "rgba(151,187,205,0.8)",
        highlightFill: "rgba(151,187,205,0.75)",
        highlightStroke: "rgba(151,187,205,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}
		]
	}
	$(document).ready(function() {
		var ctx = document.getElementById("canvas").getContext("2d"),
				myBar = new Chart(ctx).Bar(barChartData, {
			responsive: true,
	    scaleBeginAtZero : true,
	    scaleShowGridLines : true,
	    scaleGridLineColor : "rgba(0,0,0,.05)",
	    scaleGridLineWidth : 1,
	    scaleShowHorizontalLines: true,
	    scaleShowVerticalLines: true,
	    barShowStroke : true,
	    barStrokeWidth : 2,
	    barValueSpacing : 5,
	    barDatasetSpacing : 1,
	    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
		});

		var legendHolder = myBar.generateLegend();

		$('.label').append(legendHolder);
	});
</script>
