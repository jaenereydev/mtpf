<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/selectize.bootstrap3.css"/>

<div class="col-md-2">
    <div class="panel panel-default dashboard-panel">
        <div class="panel-body">
            <div class="panel-body dashboard-panel-body">
                <div class="row">

                    <!-- Icon Column -->
                    <div class="col-xs-4 text-center dashboard-icon-box">
                        <h3>
                            <span class="glyphicon glyphicon-home dashboard-icon building-color"></span>
                        </h3>
                    </div>

                    <!-- Count Column -->
                    <div class="col-xs-8 dashboard-count-box">
                        <div class="dashboard-count">
                            <h2><?php echo $buildingcount; ?></h2>
                        </div>
                        <div class="dashboard-label">
                            <h4>Active Buildings</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-body production-panel-body">
                <div class="row">

                    <!-- Icon Column -->
                    <div class="col-xs-4 text-center production-icon-box">
                        <h3>
                            <span class="glyphicon glyphicon-stats production-icon"></span>
                        </h3>
                    </div>

                    <!-- Count Column -->
                    <div class="col-xs-8 production-count-box">
                        <div class="production-count">
                            <h2 id="production-today-count">
                                <?php echo number_format(isset($production_today) ? $production_today : 0); ?>
                            </h2>
                        </div>
                        <div class="production-label">
                            <h4>Production Today</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-body production-panel-body">
                <div class="row">

                    <!-- Icon Column -->
                    <div class="col-xs-4 text-center production-icon-box">
                        <h3>
                            <span class="glyphicon glyphicon-calendar production-icon"></span>
                        </h3>
                    </div>

                    <!-- Count Column -->
                    <div class="col-xs-8 production-count-box">
                        <div class="production-count">
                            <h2 id="production-week-count">
                                <?php echo isset($production_week) ? $production_week : 0; ?>
                            </h2>
                        </div>
                        <div class="production-label">
                            <h4>This Week</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="panel-body production-panel-body">
                <div class="row">

                    <!-- Icon Column -->
                    <div class="col-xs-4 text-center production-icon-box">
                        <h3>
                            <span class="glyphicon glyphicon-stats production-icon"></span>
                        </h3>
                    </div>

                    <!-- Count Column -->
                    <div class="col-xs-8 production-count-box">
                        <div class="production-count">
                            <h2 id="production-month-count">
                                <?php echo isset($production_month) ? $production_month : 0; ?>
                            </h2>
                        </div>
                        <div class="production-label">
                            <h4>This Month</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-10" >
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="padding-top: 8px;font-size: 20px;">
                Production List
            </h3>     
            
            <div class="pull-right">

                <button type="button" data-toggle="modal" data-target="#production" class="btn btn-info " >New</button> 

                <button 
                    style="margin-left: 5px;"
                    class="btn btn-default pull-right view-building"  
                    type="button" 
                    data-toggle="modal" 
                    data-target="#view-building" >
                    <strong>BUILDING</strong >
                </button>
            </div>

            
        </div> <!-- end of panel heading -->     
        
        <div class="panel-body">  
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-responsive table-bordered table-striped info" id="MTable"> 
                <thead>
                    <tr class="info">           
                        <td class="text-center"><strong>Date</strong></td>   
                        <td class="text-center"><strong>Buidling</strong></td>        
                        <td class="text-center"><strong>Quantity</strong></td>                    
                        <td class="text-center"><strong>User</strong></td>   
                        <td class="text-center"><strong>Action</strong></td>   
                    </tr> 
                </thead>
                <tbody>
                    <?php foreach ($production as $key => $item): ?>                      
                        <tr data-production-number="<?php echo $item->production_number; ?>"> 

                            <td class="text-center">
                                <input 
                                    type="date" 
                                    class="form-control input-sm production-date auto-save-production"
                                    value="<?php echo date('Y-m-d', strtotime($item->date)); ?>">
                            </td>

                            <td class="text-center">
                                <select class="form-control input-sm production-building auto-save-production">
                                    <?php foreach ($buildinglist as $b): ?>
                                        <option 
                                            value="<?php echo $b->b_no; ?>"
                                            <?php echo ($b->b_no == $item->b_no) ? 'selected' : ''; ?>>
                                            <?php echo $b->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>

                            <td class="text-center">
                                <input 
                                    type="number" 
                                    class="form-control input-sm production-qty text-center auto-save-production"
                                    value="<?php echo $item->qty; ?>">
                            </td>

                            <td class="text-center" style="text-transform: capitalize">
                                <?php echo $item->name; ?>
                            </td>

                            <td class="text-center">     
                                <a 
                                    type="button" 
                                    title="Delete" 
                                    href="<?= site_url('production_con/deleteproduction/'. $item->production_number) ?>" 
                                    onclick="return confirm('Do you want to delete this File?');" 
                                    class="glyphicon glyphicon-trash btn btn-danger btn-sm">
                                </a> 
                            </td>

                        </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div> <!-- end of panel body -->
    </div> <!-- end of panel div -->
</div> <!-- end of main div -->

<!--Product insert Modal -->
<div id="production" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Production</h4>
        </div>
        <form role="form" method="post" onsubmit="return productionform(this);" action="<?=site_url('production_con/insertproduction')?>">                    
            <div class="modal-body">   

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" id="from" name="date" placeholder="Date"  required autocomplete="off">
                    </div>                            
                </div>  

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Building Number</label>
                    <div class="col-sm-8">
                        <select name="bno" class="btn btn-default dropdown-toggle " data-toggle="dropdown" style="width: 100% !important;" aria-expanded="true" required>                             
                            <option value=""> --Please Select--</option>
                            <?php for($b=0;$b<count($buildinglist);$b++) { ?>
                            <option value="<?php echo $buildinglist[$b]->b_no;?>" ><?php echo $buildinglist[$b]->name;?></option>
                            <?php } ?>
                        </select>  
                    </div>
                </div>

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Quantity</label>
                    <div class="col-sm-8">
                        <input class="form-control input-sm" type="number" step="any" min="0"  name="quantity" placeholder="Quantity"  required  autocomplete="off">
                    </div>                            
                </div>  

            </div>
            
            <div class="modal-footer">
                <a title="Close"  type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" > CANCEL</a>
                <input title="Save" type="Submit" name="productionbtn" class="btn btn-success glyphicon glyphicon-floppy-save" value="SAVE">
            </div>
            </div>
        </form>
    </div>
    </div>
</div> <!-- End of model -->

<!-- Modal -->
<div id="view-building" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg"> 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header"> 
                <button title="Close" class="close " data-dismiss="modal" data-toggle="modal" >&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Buidling List</h4>
            </div>
                
            <div class="modal-body">   
                <button 
                    style="margin-bottom: 5px;"
                    class="btn btn-info pull-right"  
                    type="button" 
                    data-toggle="modal" 
                    data-target="#addbuilding" >
                    <strong>New</strong >
                </button>
                <table class="table table-hover table-responsive table-bordered table-striped info" >      
                    <thead>
                    <tr class="info">                                     
                        <td class="text-center"><strong>Building Name</strong></td>       
                        <td class="text-center"><strong>Action</strong></td>
                    </tr> 
                    </thead>
                    <tbody id="history-body">
                        <!-- Content will be inserted here by JavaScript -->
                    </tbody>
                </table>                       
            </div>
                
        </div>
    </div>
</div> <!-- End of model -->

<!--Product insert Modal -->
<div id="addbuilding" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md"> 
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">                    
            <button title="Close" class="close" data-dismiss="modal" data-toggle="modal" >&times;</button>                 
            <h4 class="modal-title"><span class="glyphicon glyphicon-pencil" style="font-size: 20px;padding-right: 10px;"></span>Insert Building</h4>
        </div>
        <form role="form" onsubmit="return buildingform(this);" method="post" action="<?=site_url('Production_con/insertbuilding')?>">                    
            <div class="modal-body">   

                <div class="form-group row row-offcanvas">
                    <label class="col-sm-4 control-label">Building</label>
                    <div class="col-sm-8">
                        <input style="text-transform: capitalize;" class="form-control input-sm" type="text" name="name" placeholder="Building name"  required autocomplete="off">
                    </div>                            
                </div>
                
            </div>
            
            <div class="modal-footer">
                <a title="Close" type="button" data-dismiss="modal" data-toggle="modal" class="btn btn-danger glyphicon glyphicon-floppy-remove" > CANCEL</a>
                <input title="Save" type="Submit" name="buildingbtn" class="btn btn-success glyphicon glyphicon-floppy-save" value="SAVE">
            </div>
        </form>
    </div>
    </div>
</div> <!-- End of model -->

<script type="text/javascript" src="<?=base_url()?>public/js/datatables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>public/js/product.js"></script>

<script type="text/javascript">
    
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
});

function buildingform(formObj) {            
        formObj.buildingbtn.disabled = true;  
        formObj.buildingbtn.value = 'Please Wait...';  
        return true;    
    }  

function productionform(formObj) {            
        formObj.productionbtn.disabled = true;  
        formObj.productionbtn.value = 'Please Wait...';  
        return true;    
    }  


    $(document).ready(function() {
        $('.view-building').on('click', function() {

            $.ajax({
                url: '<?= base_url("Production_con/get_buildinglist") ?>',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    let rows = '';

                    data.forEach(function(item) {
                        let b_no = item.b_no || '';
                        let name = item.name || '';

                        rows += `
                            <tr>
                                <td>
                                    <input 
                                        type="text"
                                        class="form-control building-name-input"
                                        data-bno="${b_no}"
                                        value="${name}"
                                    >
                                </td>

                                <td class="text-center">
                                    <a 
                                        type="button" 
                                        title="Delete" 
                                        href="<?= site_url('Production_con/delbuilding/') ?>/${b_no}" 
                                        onclick="return confirm('Do you want to delete this Building?');" 
                                        class="glyphicon glyphicon-trash btn btn-danger">
                                    </a>
                                </td>
                            </tr>
                        `;
                    });

                    $('#history-body').html(rows);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Failed to load building data.');
                }
            });

    });


    // Update when user leaves the input field
    $(document).on('blur', '.building-name-input', function() {
        updateBuildingName($(this));
    });


    // Update when user presses Enter
    $(document).on('keypress', '.building-name-input', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $(this).blur();
        }
    });


    function updateBuildingName(input) {
        let b_no = input.data('bno');
        let name = input.val().trim();

        if (name === '') {
            alert('Building name cannot be empty.');
            return;
        }

        $.ajax({
            url: '<?= base_url("Production_con/update_building_name") ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                b_no: b_no,
                name: name
            },
            success: function(response) {
                if (response.status === 'success') {
                    input.addClass('input-success');

                    setTimeout(function() {
                        input.removeClass('input-success');
                    }, 1000);
                } else {
                    alert(response.message || 'Failed to update building name.');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
                alert('Error while updating building name.');
            }
        });
    }

});


// $(document).ready(function() {

//     $(document).on('click', '.save-production', function() {

//         let row = $(this).closest('tr');

//         let production_number = row.data('production-number');
//         let date = row.find('.production-date').val();
//         let b_no = row.find('.production-building').val();
//         let qty = row.find('.production-qty').val();

//         if (date === '') {
//             alert('Date is required.');
//             return;
//         }

//         if (b_no === '') {
//             alert('Building is required.');
//             return;
//         }

//         if (qty === '' || qty <= 0) {
//             alert('Quantity must be greater than zero.');
//             return;
//         }

//         $.ajax({
//             url: '<?= base_url("production_con/updateproduction_inline") ?>',
//             type: 'POST',
//             dataType: 'json',
//             data: {
//                 production_number: production_number,
//                 date: date,
//                 b_no: b_no,
//                 qty: qty
//             },
//             success: function(response) {
//                 if (response.status === 'success') {
//                     row.addClass('success');

//                     setTimeout(function() {
//                         row.removeClass('success');
//                     }, 1000);
//                 } else {
//                     alert(response.message || 'Failed to update production.');
//                 }
//             },
//             error: function(xhr) {
//                 console.log(xhr.responseText);
//                 alert('Error while updating production.');
//             }
//         });

//     });

// });
$(document).ready(function() {

    // Auto-save for date and building dropdown
    $(document).on('change', '.production-date, .production-building', function() {
        let row = $(this).closest('tr');
        autoSaveProduction(row);
    });

    // Auto-save quantity when user leaves the input
    $(document).on('blur', '.production-qty', function() {
        let row = $(this).closest('tr');
        autoSaveProduction(row);
    });

    // Auto-save quantity when user presses Enter
    $(document).on('keypress', '.production-qty', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $(this).blur();
        }
    });

    function autoSaveProduction(row) {
        let production_number = row.data('production-number');
        let date = row.find('.production-date').val();
        let b_no = row.find('.production-building').val();
        let qty = row.find('.production-qty').val();

        if (date === '') {
            alert('Date is required.');
            return;
        }

        if (b_no === '') {
            alert('Building is required.');
            return;
        }

        if (qty === '' || parseFloat(qty) <= 0) {
            alert('Quantity must be greater than zero.');
            return;
        }

        row.addClass('warning');

        $.ajax({
            url: '<?= base_url("production_con/updateproduction_inline") ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                production_number: production_number,
                date: date,
                b_no: b_no,
                qty: qty
            },
            success: function(response) {
                row.removeClass('warning');

                if (response.status === 'success') {
                    row.addClass('success');

                    setTimeout(function() {
                        row.removeClass('success');
                    }, 1000);
                } else {
                    row.addClass('danger');
                    alert(response.message || 'Failed to update production.');

                    setTimeout(function() {
                        row.removeClass('danger');
                    }, 1500);
                }
            },
            error: function(xhr) {
                row.removeClass('warning');
                row.addClass('danger');

                console.log(xhr.responseText);
                alert('Error while updating production.');

                setTimeout(function() {
                    row.removeClass('danger');
                }, 1500);
            }
        });
    }

});

$(document).ready(function() {

    function loadProductionSummary() {
        $.ajax({
            url: '<?= base_url("production_con/get_production_summary") ?>',
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(response) {

                var today = parseFloat(response.production_today) || 0;
                var week = parseFloat(response.production_week) || 0;
                var month = parseFloat(response.production_month) || 0;

                $('#production-today-count').text(today.toLocaleString('en-US'));
                $('#production-week-count').text(week.toLocaleString('en-US'));
                $('#production-month-count').text(month.toLocaleString('en-US'));
            },
            error: function(xhr, status, error) {
                console.log('Production Summary Error:', xhr.responseText);
            }
        });
    }

    // Load immediately
    loadProductionSummary();

    // Auto-update every 5 seconds
    setInterval(loadProductionSummary, 2000);

});



</script>

<style>
    .building-name-input {
        text-align: center;
        font-weight: 600;
    }

    .building-name-input:focus {
        border-color: #337ab7;
        box-shadow: 0 0 5px rgba(51, 122, 183, 0.5);
    }

    .input-success {
        border-color: #5cb85c !important;
        background-color: #dff0d8 !important;
    }

    #MTable input,
    #MTable select {
        min-width: 100%;
    }

    #MTable tr.warning td {
        background-color: #fcf8e3 !important;
    }

    #MTable tr.success td {
        background-color: #dff0d8 !important;
    }

    #MTable tr.danger td {
        background-color: #f2dede !important;
    }

    .production-panel-body {
        padding: 10px;
    }

    .production-icon-box {
        border-right: 1px solid #ddd;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .production-icon {
        font-size: 38px;
        color: #5cb85c;
    }

    .production-count-box {
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .production-count h2 {
        margin: 0;
        font-size: 32px;
        font-weight: bold;
        color: #333;
    }

    .production-label h4 {
        margin: 5px 0 0;
        font-size: 13px;
        color: #777;
        text-transform: uppercase;
    }

     .dashboard-panel {
        border-radius: 4px;
    }

    .dashboard-panel-body {
        padding: 10px;
    }

    .dashboard-icon-box {
        border-right: 1px solid #ddd;
        min-height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dashboard-icon-box h3 {
        margin: 0;
    }

    .dashboard-icon {
        font-size: 38px;
    }

    .building-color {
        color: #337ab7;
    }

    .production-color {
        color: #5cb85c;
    }

    .dashboard-count-box {
        min-height: 80px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dashboard-count h2 {
        margin: 0;
        font-size: 32px;
        font-weight: bold;
        color: #333;
    }

    .dashboard-label h4 {
        margin: 5px 0 0;
        font-size: 13px;
        color: #777;
        text-transform: uppercase;
        line-height: 1.2;
    }
</style>