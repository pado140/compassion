<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title_for_layout; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo VENDOR_URL; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo VENDOR_URL; ?>nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo VENDOR_URL; ?>iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo VENDOR_URL; ?>bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo VENDOR_URL; ?>jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo VENDOR_URL; ?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo CSS_URL; ?>build/css/custom.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo VENDOR_URL; ?>toastr/toastr.min.css" rel="stylesheet">


    <!-- jQuery -->
    <script src="<?php echo VENDOR_URL; ?>jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo VENDOR_URL; ?>bootstrap/dist/js/bootstrap.min.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
                <?php $this->load->view('layout/left-side'); ?>   
                <!-- top navigation -->
                 <?php $this->load->view('layout/header'); ?>   
                <!-- /top navigation -->

        

        <!-- page content -->
        <div class="right_col" role="main">
            <?php echo $content_for_layout; ?>
                    <!-- /page content -->                   
                </div>
                <!-- footer content -->
                <?php $this->load->view('layout/footer'); ?>   
                <!-- /footer content -->
                
      </div>
    </div>

    <!-- FastClick -->
    <script src="<?php echo VENDOR_URL; ?>fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo VENDOR_URL; ?>nprogress/nprogress.js"></script>
         <!-- bootstrap-progressbar -->
    <script src="<?php echo VENDOR_URL; ?>bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo VENDOR_URL; ?>iCheck/icheck.min.js"></script>
    <link href="<?php echo VENDOR_URL; ?>datatables/buttons.dataTables.min.css" rel="stylesheet"> 
        <link href="<?php echo VENDOR_URL; ?>datatables/dataTables.bootstrap.css" rel="stylesheet"> 
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/jquery.dataTables.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/dataTables.buttons.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/pdfmake.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/jszip.min.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/vfs_fonts.js"></script>
        <script src="<?php echo VENDOR_URL; ?>datatables/tools/buttons.html5.min.js"></script> 
        <script src="<?php echo VENDOR_URL; ?>datatables/dataTables.bootstrap.js"></script> 
    
    <!-- DateJS -->
    <script src="<?php echo VENDOR_URL; ?>DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo VENDOR_URL; ?>jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo VENDOR_URL; ?>jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo VENDOR_URL; ?>jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo VENDOR_URL; ?>moment/min/moment.min.js"></script>
    <script src="<?php echo VENDOR_URL; ?>bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Validation-->
    <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>

    <!--Toast-->
    <script src="<?php echo VENDOR_URL; ?>toastr/toastr.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo JS_URL; ?>build/js/custom.min.js"></script>

    <!-- JQVMap -->
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
        });
      });
    </script>
    <!-- /JQVMap -->

    
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->
<script type="text/javascript">
       
       jQuery.extend(jQuery.validator.messages, {
                required: "<?php echo $this->lang->line('required_field'); ?>",
                email: "<?php echo $this->lang->line('enter_valid_email'); ?>",
                url: "<?php echo $this->lang->line('enter_valid_url'); ?>",
                date: "<?php echo $this->lang->line('enter_valid_date'); ?>",
                number: "<?php echo $this->lang->line('enter_valid_number'); ?>",
                digits: "<?php echo $this->lang->line('enter_only_digit'); ?>",
                equalTo: "<?php echo $this->lang->line('enter_same_value_again'); ?>",
                remote: "<?php echo $this->lang->line('pls_fix_this'); ?>",
                dateISO: "Please enter a valid date (ISO).",
                maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
                minlength: jQuery.validator.format("Please enter at least {0} characters."),
                rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
                 range: jQuery.validator.format("Please enter a value between {0} and {1}."),
                max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
                min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
            });
       </script>
  </body>
</html>
       