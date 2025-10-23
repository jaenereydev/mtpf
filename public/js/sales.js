$(document).ready(function() {
	// $('#MTable').DataTable();  
	 $('#searchCustomer').selectize({
		create: false,
    sortField: 'text',
    maxItems: 1,
    maxOptions: 10
	});

	$('.dateTimePicker').datetimepicker({format: 'MMM. DD, YYYY', showTodayButton: true});
});

$('#STable').on('click', 'button', function(event) {
	var id = $(this).closest('tr').data('id');
	$('#dbutton').data('id', id);
});

$('#SDelete').on('click', '.btn-danger', function(event) {
	var id = $(this).data('id')
	$.post('sales_con/remove_selected', {id: id}, function(data) {
		totalUpdater(JSON.parse(data));
	});

	$('#STable [data-id~=' + id +']').remove();

	if($('#STable').find('tr').length == 1){
		$('#STable tbody').append('<tr class="noItem"><td colspan="8">No item in the cart</td></tr>')
		$('body').find('.hideThis').each(function(index, el) {
			$(this).addClass('hidden');
		});
	}
	$('#SDelete').modal('hide');
});

// var MTable = function(data)
// {
// 	var data = [];
// 	$.each(data, function(index, val) {
// 		data.push([
// 				val.longdesc,
// 				val.qty,
// 				val.price1,
// 				'<button class="btn btn-primary btn-sm btn-block product-list" data-id="<?php echo $item->p_no; ?>" data-dismiss="modal">Select</button>'
// 			])
// 	});

// 	return data;
// }

$('#PSearch').submit(function(event) {
	event.preventDefault();
	$('#MTable').DataTable().destroy();
	$('#MTable').DataTable({
		"bDestroy": true,
    // "bProcessing": true,
    "sAjaxSource": "sales_con/get_productList"
	}); 

	$('#ProductList').modal('show');
});

$(document).on('click', '.product-list', function(event) {
	// event.preventDefault();
// $().click(function(event) {
	var id  = $(this).data('id'),
		  qty = $('#qty').val(),
		  url = $('#qty').closest('form')[0].action,
		  $table = $('#STable tbody');

	$.post(url, {id: id, qty: qty}, function(data) {
		if($table.find('.noItem').length == 1)
			$table.find('.noItem').remove();
		data = JSON.parse(data);

		$table.append(data[0][0]);

		// if(data[1][3] > 0){
		// 	$('#paymentBtn').removeAttr('disabled');
		// 	$('[href~=#SComplete]').addClass('hidden');
		// }

		if(data[0][1]){
			$('.adjustLabel').each(function(index, el) {
				$(this).text(data[0][1]);
			});
		}
		totalUpdater(data[1]);

		if($('#STable tbody tr td').length != 1){
			$('body').find('.hideThis').each(function(index, el) {
				if($(this).hasClass('hidden'))
					$(this).removeClass('hidden')
			});
		}

    $('[data-toggle~=tooltip]').tooltip();
	});

	$('#qty').val('');
});

$('#STable').on('click', 'tr', function(event) {
	var id = $(this).closest('tbody').find('.success').toggleClass('success').data('id');
	if(id != $(this).data('id'))
		$(this).toggleClass('success');

	$('[data-toggle="tooltip"]').tooltip('hide');
});

$(document).keyup(function(event) {
	var Selector = $('#STable tbody');
	var hasClass = Selector.find('tr').hasClass('success');
	if(hasClass){
		var tr = Selector.find('.success');
		var $id = tr.data('id');

		if(event.keyCode == 69){
			$.post('sales_con/price_changer', {id: $id}, function(data) {
				updater(JSON.parse(data), tr);
			});
		} else if (event.keyCode == 68){
			$.post('sales_con/price_changer', {discount: $id}, function(data) {
				updater(JSON.parse(data), tr);
			});
		}
	}
});

$('[data-toggle~=tooltip]').on('show.bs.tooltip', function () {
	$('[data-toggle="tooltip"]').not(this).tooltip('hide');
})

$('html').click(function(event) {
	$('[data-toggle="tooltip"]').tooltip('hide');
});


$('#paymentForm').submit(function(event) {
	event.preventDefault();
	var url = $(this).attr('action'),
			condition = $('#paymentType').val(),
			selectize = $('#searchCustomer').selectize(),
			that = $(this);

	if($('#STable tbody tr td').length == 1)
		return false;

	if(condition != 'cash' && selectize[0].selectize.getValue() == ''){
		selectize[0].selectize.focus();
		return false;
	}


	if(condition == 'check'){
		var amountDue = $('.amountDue').text();
				amountDue = amountDue.replace('P ', '');

		if(parseInt($('#check_amount').val()) < parseInt(amountDue))
			return false;
	}

	$.post(url, {data : $(this).serialize()}, function(data) {
		var data = JSON.parse(data);
		$('#paidRegister').removeClass('hidden');

		var tr = '<tr> <td>' + data['paid'][(data['paid']).length - 1][0] + '</td> <td>' + isFloat(data['paid'][(data['paid']).length - 1][1]) + '</td> </tr>';
		$('#paidRegister tbody').append(tr);

		if(data[3] <= 0){
			$('[href~=#SComplete]').removeClass('hidden').focus();
			$('#SCompleteModal span').text(isFloat(Math.abs(data[3])));
			$('[name~=amountPaid]').val(isFloat(data[3]));
			$('#paymentBtn').prop('disabled', 'true');
		// }
		
			$('body').find('.toggler').attr('disabled', 'disabled');
			$('#STable').find('button').attr('disabled', 'disabled');

			selectize[0].selectize.disable();

			$('#STable').unbind('click');
		}

		$('[name~=amountPaid]').val('').focus();
		totalUpdater(data);
	});
});

$('.modal').on('shown.bs.modal', function (e) {
	$(this).find('.yes').focus();
})

$('#paymentType').change(function(event) {
	var that = $(this);
	if($(this).val() != 'cash')
		$('[name~=amountPaid]').attr('disabled', 'disabled');
	else
		$('[name~=amountPaid]').removeAttr('disabled');

	$('#checkDetails').collapse('hide')

	$('#checkDetails').find('input').each(function(index, el){
		var checker = $(this).attr('disabled');
			if(typeof checker === typeof undefined){
				$(this).attr('disabled', 'disabled');
				$(this).removeAttr('required');
				return;
			} else if(that.val() == 'check'){
				$(this).removeAttr('disabled');
				$(this).attr('required', 'required');
			}
	});

	if($(this).val() == 'check')
		$('#checkDetails').collapse('show')
});

(function(){
	var toggler = '[data-disabler]',
			$target;

	$(toggler).click(function(event) {
		$target = $(this).attr('href');

		$($target).find('input').each(function(index, el) {
			var checker = $(this).attr('disabled');
			if(typeof checker === typeof undefined){
				$(this).attr('disabled', 'disabled').val('');
				$(this).removeAttr('required');
				$.post('sales_con/disc_additional', {exit: $(this).attr('name')}, function(data) {
					totalUpdater(JSON.parse(data));
				});
				return;
			} 

			$(this).removeAttr('disabled');
			$(this).attr('required', 'required');
		});
	});
})();

(function(){
	var toggler = '[data-change]';

	$(toggler).change(function(event) {
		$.post('sales_con/disc_additional', {name: $(this).attr('name'), 'val': $(this).val()}, function(data) {
			data = JSON.parse(data);
			totalUpdater(data);
		});
	});

})();

$('#addCustomer').submit(function(event) {
	event.preventDefault();
	var data = $(this).serialize();
	$.post('sales_con/add_customer', {data: data}, function(data) {
		var selectize = $('#searchCustomer').selectize(),
				data = JSON.parse(data);
				selectize[0].selectize.addOption(data);
				selectize[0].selectize.addItem(data['value']);
	});

	$('#myModal').modal('hide');
	$(this)[0].reset();
	return false;
});

$('body').on('change', '[name~=adjust]', function(event) {
	var $this = $(this),
			$parent = $this.closest('tr').data('id'),
			$qty = $this.closest('tr').find('td').eq(4).text();

			if(parseInt($qty) < $this.val()){
				$this.val(Math.round($qty))
			} else
				$this.val(Math.floor($this.val()))

	$.post('sales_con/adjustment', {id: $parent, val: $this.val()}, function(data) {
	});
});

var updater = function(data, tr){
	totalUpdater(data[3]);
	 if(tr.find('[name~=override]')[0])
		tr.find('[name~=override]').val(setTwoNumberDecimal(data[2]))
	else
		tr.find('td:nth-child(6)').text(isFloat(data[2]));
	tr.find('td:nth-child(4) span').text(isFloat(data[1])).attr('title', data[0][0]).tooltip('fixTitle').tooltip('show');
	tr.find('td:nth-child(4) strong').text(data[0][1]);
}

var totalUpdater = function(sum){
	$('.price').each(function(index, el) {
		if(index == 0)
			$(el).text(sum[index]);
		else
			$(el).text(isFloat(sum[index]));
	});
}

var isFloat = function(n){
	if(n % 1 === 0)
		return 'P ' + n + ".00";
	else
		return 'P ' + n; 
}

function setTwoNumberDecimal(number) {
   return parseFloat(number).toFixed(2);
}

$('body').on('change', '.override', function(event) {
	var $this = $(this),
			$parent = $this.closest('tr').data('id');

	$.post('sales_con/override', {id: $parent, val: $this.val()}, function(data) {
		data = JSON.parse(data);
		totalUpdater(data[1]);
		$this.val(setTwoNumberDecimal(data[0]))
	});

});

$('#invoice').change(function(event) {
	var $this = '#' + $(this).val();
	$('[data-parent~=#SComplete]').collapse('hide');
	$($this).collapse('show');
});


