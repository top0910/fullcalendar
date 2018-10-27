
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2018 Strata365.com &nbsp &nbsp Need Help : - <a href="mailto:support@strata365.com">Support Question</a> </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
        
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    <!-- Calendar JavaScript -->
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/calendar/jquery-ui.min.js"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/moment/moment.js"></script>
    <script src='<?= base_url()?>assets/material-pro/assets/plugins/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/dropzone-master/dist/dropzone.js"></script>

    <script src="<?= base_url()?>assets/material-pro/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- ============================================================== -->
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/switchery/dist/switchery.min.js"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="<?= base_url()?>assets/material-pro/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>

    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
    </script>

        
<script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>


<!-- ******************TinyMCE STARTS****************** -->
<!-- <script>tinymce.init({ selector:'textarea',
  height: 250,
  theme: 'modern',

  plugins: [
  'advlist autolink autosave lists charmap print preview hr pagebreak',
  'searchreplace wordcount visualblocks visualchars code fullscreen',
  'insertdatetime nonbreaking save table contextmenu directionality',
  'emoticons paste textcolor colorpicker textpattern '
  ],
  toolbar1: ' styleselect | bold italic underline | forecolor backcolor media | ',
  fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 72pt',
  image_advtab: true,
  content_css: [
  'http://fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  'http://www.tinymce.com/css/codepen.min.css'
  ]
});</script> -->
<!-- ******************TinyMCE ENDS****************** -->
        
    <!-- <script src="<?= base_url()?>assets/material-pro/assets/plugins/calendar/dist/cal-init.js"></script> -->
    <!-- ============================================================== -->


    <!-- ============================================================== -->
    
<script>
    $(document).ready(function(){
        $('#table_id').DataTable({
            "order": [[ 1, "desc" ]],
                    dom: '<"top"Bf>rt<"bottom"lip><"clear">',
        // dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50,100, -1 ],
            [ '10 rows', '25 rows', '50 rows','100 rows', 'Show all' ]
        ],

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print','pageLength',
        ]

        });
    });
</script>
    <script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 400,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->

<!-- Footer Starts -->
<script>
    // Message alert box 
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
<style> 
/* for alert popup cross button floating */
  .alink{
          float: right;
         }
</style>

<script>
    // Form validation script for http://www.formvalidator.net/
  $.validate({
    lang: 'es'
  });
</script>
    
</body>

</html>