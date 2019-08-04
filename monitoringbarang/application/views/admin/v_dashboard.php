<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Monitoring Barang Habis Pakai</title>

        <meta name="description" content="">
        <meta name="robots" content="noindex, nofollow">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url().'assets/images/favicon.png'?>">

        <!-- END Icons -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/js/plugins/datatables/dataTables.bootstrap4.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/dropify.min.css'?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url().'assets/css/codebase.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>


    </head>
    <body>
        <!-- Page Container -->
       
        <div id="page-container" class="sidebar-o side-scroll main-content-boxed side-trans-enabled page-header-fixed">
            
            <?php $x["active"]="dashboard"; $this->load->view('admin/sidebar.php', $x);?>
            <?php echo $this->load->view('admin/header.php');?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <center>
                        <img src="<?php echo base_url().'assets/images/bgd.jpg'?>">
                    </center>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
            
            <?php echo $this->load->view('admin/footer.php');?>

        </div>
        <!-- END Page Container -->



        <!-- Codebase Core JS -->
        <script src="<?php echo base_url().'assets/js/core/jquery.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/popper.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/bootstrap.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.slimscroll.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.scrollLock.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.appear.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.countTo.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/js.cookie.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/codebase.js'?>"></script>
        <script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/plugins/datatables/jquery.dataTables.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/plugins/datatables/dataTables.bootstrap4.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/dropify.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

        <!-- Page JS Plugins -->
        <script src="<?php echo base_url().'assets/js/plugins/chartjs/Chart.bundle.min.js'?>"></script>

        <!-- Page JS Code -->


        <script type="text/javascript">
            $(document).ready(function(){


                var BePagesDashboard = function() {
                    // Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
                    var initDashboardChartJS = function () {
                        // Set Global Chart.js configuration
                        Chart.defaults.global.defaultFontColor              = '#555555';
                        Chart.defaults.scale.gridLines.color                = "transparent";
                        Chart.defaults.scale.gridLines.zeroLineColor        = "transparent";
                        Chart.defaults.scale.display                        = false;
                        Chart.defaults.scale.ticks.beginAtZero              = true;
                        Chart.defaults.global.elements.line.borderWidth     = 2;
                        Chart.defaults.global.elements.point.radius         = 5;
                        Chart.defaults.global.elements.point.hoverRadius    = 7;
                        Chart.defaults.global.tooltips.cornerRadius         = 3;
                        Chart.defaults.global.legend.display                = false;

                        // Chart Containers
                        var chartDashboardLinesCon  = jQuery('.js-chartjs-dashboard-lines');
                        var chartDashboardLinesCon2 = jQuery('.js-chartjs-dashboard-lines2');

                        // Chart Variables
                        var chartDashboardLines, chartDashboardLines2;

                        // Lines Charts Data
                        var chartDashboardLinesData = {
                            labels: <?php echo json_encode($bulan);?>,
                            datasets: [
                                {
                                    label: 'This Week',
                                    fill: true,
                                    backgroundColor: 'rgba(66,165,245,.25)',
                                    borderColor: 'rgba(66,165,245,1)',
                                    pointBackgroundColor: 'rgba(66,165,245,1)',
                                    pointBorderColor: '#fff',
                                    pointHoverBackgroundColor: '#fff',
                                    pointHoverBorderColor: 'rgba(66,165,245,1)',
                                    data: <?php echo json_encode($value);?>
                                }
                            ]
                        };

                        var chartDashboardLinesOptions = {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMax: 50
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItems, data) {
                                        return ' ' + tooltipItems.yLabel + ' Visitors';
                                    }
                                }
                            }
                        };

                        var chartDashboardLinesData2 = {
                            labels: <?php echo json_encode($month);?>,
                            datasets: [
                                {
                                    label: 'This Week',
                                    fill: true,
                                    backgroundColor: 'rgba(156,204,101,.25)',
                                    borderColor: 'rgba(156,204,101,1)',
                                    pointBackgroundColor: 'rgba(156,204,101,1)',
                                    pointBorderColor: '#fff',
                                    pointHoverBackgroundColor: '#fff',
                                    pointHoverBorderColor: 'rgba(156,204,101,1)',
                                    data: <?php echo json_encode($count);?>
                                }
                            ]
                        };

                        var chartDashboardLinesOptions2 = {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMax: 480
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItems, data) {
                                        return ' ' + tooltipItems.yLabel + ' Visitors';
                                    }
                                }
                            }
                        };

                        // Init Charts
                        if ( chartDashboardLinesCon.length ) {
                            chartDashboardLines  = new Chart(chartDashboardLinesCon, { type: 'line', data: chartDashboardLinesData, options: chartDashboardLinesOptions });
                        }

                        if ( chartDashboardLinesCon2.length ) {
                            chartDashboardLines2 = new Chart(chartDashboardLinesCon2, { type: 'line', data: chartDashboardLinesData2, options: chartDashboardLinesOptions2 });
                        }
                    };

                    return {
                        init: function () {
                            // Init Chart.js Charts
                            initDashboardChartJS();
                        }
                    };
                }();

                // Initialize when page loads
                jQuery(function(){ BePagesDashboard.init(); });
            });
        </script>
    </body>
</html>