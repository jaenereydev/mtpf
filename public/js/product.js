$(document).ready(function() {
	$('#MTable').DataTable();	
});

$(document).ready(function() {
	$('#CoTable').DataTable();	
});

$(document).ready(function() {
	$('#ThirdTable').DataTable();	
});

$('#STable').on('click', 'button', function(event) {
	var id = $(this).closest('tr').data('id');
	$('#dbutton').data('id', id);
});

$('#PSearch').submit(function(event) {
	event.preventDefault();
	$('#ProductList').modal('show');
});


$('[data-toggle~=tooltip]').on('show.bs.tooltip', function () {
	$('[data-toggle="tooltip"]').not(this).tooltip('hide');
});

$('html').click(function(event) {
	$('[data-toggle="tooltip"]').tooltip('hide');
});

