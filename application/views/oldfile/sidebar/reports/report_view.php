<link rel="stylesheet" href="<?php echo base_url('public/css/custom.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap-datetimepicker.min.css') ?>">
<div class="col-md-10 main pl0">
  <div class="panel panel-default">
    <div class="panel-heading fsize16">
      <span class="glyphicon glyphicon-signal"></span> Reports
    </div>
    <div class="panel-body">
    	<div class="row">
    		<div class="col-xs-3 pl15 list-group" id="navTabs">
				  <span class="list-group-item" aria-controls="" role="tab" data-toggle="tab">
				  	<span class="glyphicon glyphicon-th"></span> Categories
				  </span>
				  <?php 
				  foreach ($tabs as $value): ?>
				  	<a href="#<?php echo $value['href'] ?>" class="list-group-item" aria-controls="" role="tab" data-toggle="tab">
				  		<span class="glyphicon glyphicon-<?php echo $value['icon'] ?>"></span> <?php echo $value['text'] ?>
				  	</a>
				  <?php endforeach ?>
    		</div>
    		<div class="col-xs-9">
	    		<div class="form-group">
	    			<div class="panel panel-default">
	    				<div class="panel-body">
			    			<div class="tab-content">
			    				<?php foreach ($tabs as $key => $value): ?>
			    					<div role="tabpanel" class="tab-pane " id="<?php echo $value['href'] ?>">
								    	<div class="page-header nm">
											  <h4 class="nm"><span class="glyphicon glyphicon-<?php echo $value['icon'] ?>"></span> <?php echo $value['text'] ?></h4>
											</div>
											<?php foreach ($value['tab'] as $key => $tab): ?>
												<?php if((isset($value['separate']) && (isset($tab['position']) && $tab['position'] == 'start')) || $key == 0): ?>
													<div class="list-group pt10 mb0">
												<?php endif ?>
												<?php if($tab['id'] == 'GR'): ?>
													<a href="<?php echo site_url($tab['href']); ?>" class="list-group-item">
													<span class="glyphicon glyphicon-equalizer"></span> <?php if(isset($tab['text'])) echo $tab['text']; else echo 'Graphical Reports'; ?></a>
												<?php elseif ($tab['id'] == 'SR'): ?>
													<a href="<?php echo site_url($tab['href']); ?>" class="list-group-item"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Summary Reports</a>
												<?php else: ?>
													<a href="<?php echo site_url($tab['href']) ?>" class="list-group-item">
														<span class="glyphicon glyphicon-<?php echo $value['icon'] ?>"></span>
														<?php echo $tab['text'] ?>
													</a>
												<?php endif; ?>
												<?php if((isset($value['separate']) && (isset($tab['position']) && $tab['position'] == 'end')) || $key == sizeof($value['tab']) - 1): ?>
													</div>
												<?php endif ?>
											<?php endforeach ?>
								    </div>
			    				<?php endforeach ?>
							  </div>
	    				</div>
	    			</div>
	    		</div>
    		</div>
    	</div>
    </div>
  </div>
</div>
<script src="<?=base_url('public/js/moment.js')?>"></script> 
<script src="<?=base_url('public/js/bootstrap-datetimepicker.min.js')?>"></script> 
<script>
	$('#navTabs').click(function(event) {
		$('.tab-content').find('.active').removeClass('active');
	});
  $('.datepicker').datetimepicker({format: 'MMM. DD, YYYY', showTodayButton: true});
</script>