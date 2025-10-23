 </div><!--end of row -->
 </div><!--end of div-->
        <script src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url('public/js/bootstrap.min.js')?>"></script> 
        <script type="text/javascript">
            // When the document is ready
          $(document).ready(function () {
            $('[data-toggle~=tooltip]').tooltip();
            $('#birthday').datepicker({format: "mm/dd/yyyy"});
            $('#fbirthday').datepicker({format: "mm/dd/yyyy"});
            $('#mbirthday').datepicker({format: "mm/dd/yyyy"});
            $('#from').datepicker({format: "mm/dd/yyyy"});
            $('#to').datepicker({format: "mm/dd/yyyy"});
            $('#from2').datepicker({format: "mm/dd/yyyy"});
            $('#to2').datepicker({format: "mm/dd/yyyy"});
          });
          
        </script>
        
</body>
</html>