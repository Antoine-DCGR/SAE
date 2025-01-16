<?php
require "view_begin.php";
?>

<body>
    <header class="header">
        <div class="header-row" role="navigation" aria-label="Main">
            <div class="logo">
                <a href="?Controller=authentification&&action=authentification" class="custom-mobile-logo-link"
                    rel="home" itemprop="url" role="link">
                    <img src="Contenu/im/logo-univ.png" alt="Logo">
                </a>
            </div>
            <div class="header-right">
                <ul class="main-menu">
                    <!-- Rubriques communes à tous les utilisateurs -->
                    <li class="menu-item"><a href="?controller=affichage&&action=tableDeBord" class="active">Tableau
                            de bord</a></li>


                    <li class="menu-item">
                        <a href="?controller=affichage&&action=listePersonne&&start=1">Voir les personnes</a>
                    </li>
                    <li class="menu-item mega-menu">
                        <a href="?controller=affichage&&action=listeDepartement">Départements</a>
                    </li>
                    <?php if ($_SESSION["role"] == 'Chef de département' || $_SESSION["role"] == 'Enseignant' || $_SESSION["role"] == 'Secrétaire'): ?>
                        <!-- Rubriques spécifiques au Directeur -->
                        <li class="menu-item">
                            <a href="?controller=affichage&&action=monDepartement">Mon départements</a>
                        </li>
                    <?php endif; ?>

                    <nav>
                        <ul class="sidebar">
                            <button type="button" onclick="HideSidebar()" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                            <li id="black"><a href="?controller=affichage&&action=profil">
                                    <?= $_SESSION['nom'] ?>
                                </a>
                            </li>
                            <?php if ($_SESSION['role'] == 'Directeur' || $_SESSION['role'] == 'Équipe de direction'): ?>
                                <li id="black"> <a href="?controller=affichage&&action=afficherLogs">Logs</a>
                                </li>
                            <?php endif ?>

                            <li class="role-enseignant" id="black"><a
                                    href="?controller=authentification&action=deconnection">Déconnexion</a>
                            </li>
                        </ul>
                        <ul class="deplace">
                            <li onclick=ShowSidebar() id="menu-btn" class="menu-item"><i class="fas fa-user"></i>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>
    </header>

    <!-- page-content-wrapper -->
    <div class="page-content-toggle" id="page-content-wrapper">
        <div class="container-fluid">

            <!-- 1st row -->
            <div class="row m-b-2">
                <div class="col-lg-4">
                    <div class="card card-block">
                        <h4 class="card-title">Utilisateurs</h4>
                        <div id="users-device-doughnut-chart"></div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card card-block">
                        <h4 class="card-title m-b-2">Enseignants du département INFO</h4>
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-block">
                <h4 class="card-title">COMP vs STAT</h4>
                <div id="users-medium-pie-chart"></div>
            </div>
        </div>
    </div>

    <!-- page-content-wrapper -->
    <div class="page-content-toggle" id="page-content-wrapper">
        <div class="container-fluid">
            <!-- 2nd row -->
            <div class="row m-b-1">
                <div class="col-md-12">
                    <div class="card card-block">
                        <h4 class="card-title m-b-2">Enseignant de L'IUT</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div id="annual-revenue-by-category-pie-chart"></div>
                            </div>
                            <div class="col-md-8 hidden-sm-down">
                                <div id="monthly-revenue-by-category-column-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /page-content-wrapper -->

    <section class="footer">
        <div class="box-container">

            <div class="box">
                <h3>Liens rapides</h3>
                <a href="?Controller=authentification&&action=authentification"><i
                        class="fas fa-angle-right    "></i>Accueil </a>
                <a href="?controller=affichage&&action=profil"><i class="fas fa-angle-right    "></i>A
                    propos </a>
                <a href="#"><i class="fas fa-angle-right    "></i>Paquets </a>
            </div>
            <div class="box">
                <h3>Liens extra</h3>
                <a href="#"><i class="fas fa-angle-right    "></i>Posez questions </a>
                <a href="#"><i class="fas fa-angle-right    "></i>A propos de nous </a>
                <a href="#"><i class="fas fa-angle-right    "></i>Politique de confidentialité </a>
                <a href="#"><i class="fas fa-angle-right    "></i>Nos termes </a>
            </div>

            <div class="box">
                <h3>info contact</h3>
                <a href="#"><i class="fas fa-phone    "></i>+33 06324564</a>
                <a href="#"><i class="fas fa-phone    "></i>+33 07121315</a>
                <a href="#"><i class="fas fa-envelope    "></i>vortext.topaze@gmail.com</a>
                <a href="#"><i class="fas fa-envelope    "></i>Responsablevortex@yahoo.fr</a>
                <a
                    href="https://www.bing.com/search?q=51+Rue+de+Bercy%2C+75012+Paris&form=ANNTH1&refig=e566bfebc6634877b03b0bf7667338fb"><i
                        class="fas fa-map    "></i>VORTEX - TEAM </a>
            </div>
            <div class="box">
                <h3>suivez nous</h3>
                <a href="#"><i class="fab fa-facebook    "></i>facebook </a>
                <a href="#"><i class="fab fa-twitter    "></i>twitter </a>
                <a href="#"><i class="fab fa-instagram    "></i>instagram </a>
                <a href="#"><i class="fab fa-linkedin    "></i>linkedIn </a>
            </div>
        </div>
        <div class="home-right">
            Créé par <span>Vortex</span> | Tous les droits sont réservés.
        </div>
    </section>

    <script src="Contenu/js/tab.js"></script>
    <script>
        var graphData = <?php echo json_encode($graphData, JSON_NUMERIC_CHECK); ?>;
        var serviceStatistics = <?php echo json_encode($serviceStatistics); ?>;
        var teacherStatistics = <?php echo json_encode($teacherStatistics); ?>;
        var teacherStatisticsIUT = <?php echo json_encode($teacherStatisticsIUT); ?>;


        window.onload = function () {
            // renderChartContainer1();
            renderChartContainer(graphData, serviceStatistics, teacherStatistics);

        };

        function renderChartContainer1() {
            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,

                axisX: {
                    valueFormatString: "DDD"
                },
                axisY: {
                    prefix: "$"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "stackedBar",
                    name: "Meals",
                    showInLegend: "true",
                    xValueFormatString: "DD, MMM",
                    yValueFormatString: "$#,##0",
                    dataPoints: [
                        { x: new Date(2017, 0, 30), y: 56 },
                        { x: new Date(2017, 0, 31), y: 45 },
                        { x: new Date(2017, 1, 1), y: 71 },
                        { x: new Date(2017, 1, 2), y: 41 },
                        { x: new Date(2017, 1, 3), y: 60 },
                        { x: new Date(2017, 1, 4), y: 75 },
                        { x: new Date(2017, 1, 5), y: 98 }
                    ]
                },
                {
                    type: "stackedBar",
                    name: "Snacks",
                    showInLegend: "true",
                    xValueFormatString: "DD, MMM",
                    yValueFormatString: "$#,##0",
                    dataPoints: [
                        { x: new Date(2017, 0, 30), y: 86 },
                        { x: new Date(2017, 0, 31), y: 95 },
                        { x: new Date(2017, 1, 1), y: 71 },
                        { x: new Date(2017, 1, 2), y: 58 },
                        { x: new Date(2017, 1, 3), y: 60 },
                        { x: new Date(2017, 1, 4), y: 65 },
                        { x: new Date(2017, 1, 5), y: 89 }
                    ]
                },
                {
                    type: "stackedBar",
                    name: "Drinks",
                    showInLegend: "true",
                    xValueFormatString: "DD, MMM",
                    yValueFormatString: "$#,##0",
                    dataPoints: [
                        { x: new Date(2017, 0, 30), y: 48 },
                        { x: new Date(2017, 0, 31), y: 45 },
                        { x: new Date(2017, 1, 1), y: 41 },
                        { x: new Date(2017, 1, 2), y: 55 },
                        { x: new Date(2017, 1, 3), y: 80 },
                        { x: new Date(2017, 1, 4), y: 85 },
                        { x: new Date(2017, 1, 5), y: 83 }
                    ]
                },
                {
                    type: "stackedBar",
                    name: "Dessert",
                    showInLegend: "true",
                    xValueFormatString: "DD, MMM",
                    yValueFormatString: "$#,##0",
                    dataPoints: [
                        { x: new Date(2017, 0, 30), y: 61 },
                        { x: new Date(2017, 0, 31), y: 55 },
                        { x: new Date(2017, 1, 1), y: 61 },
                        { x: new Date(2017, 1, 2), y: 75 },
                        { x: new Date(2017, 1, 3), y: 80 },
                        { x: new Date(2017, 1, 4), y: 85 },
                        { x: new Date(2017, 1, 5), y: 105 }
                    ]
                },
                {
                    type: "stackedBar",
                    name: "Takeaway",
                    showInLegend: "true",
                    xValueFormatString: "DD, MMM",
                    yValueFormatString: "$#,##0",
                    dataPoints: [
                        { x: new Date(2017, 0, 30), y: 52 },
                        { x: new Date(2017, 0, 31), y: 55 },
                        { x: new Date(2017, 1, 1), y: 20 },
                        { x: new Date(2017, 1, 2), y: 35 },
                        { x: new Date(2017, 1, 3), y: 30 },
                        { x: new Date(2017, 1, 4), y: 45 },
                        { x: new Date(2017, 1, 5), y: 25 }
                    ]
                }]
            });
            chart1.render();



            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart1.render();
            }
        };
        function renderChartContainer(graphData, serviceStatistics, teacherStatistics) {
            var totalServices = serviceStatistics.statutaire + serviceStatistics.complementaire;

            var totalTeachers = teacherStatistics.reduce(function (a, b) {
                return a + b.totalteachers;
            }, 0);

            var teacherDataPoints = teacherStatistics.map(function (teacherStat) {
                var percentage = (totalTeachers > 0) ? (teacherStat.totalteachers / totalTeachers) * 100 : 0;
                return {
                    y: teacherStat.totalteachers,
                    name: teacherStat.siglecat + ' (' + percentage.toFixed(2) + '%)',
                    legendText: teacherStat.siglecat, // Ajout du siglecat dans la légende
                };
            });

            var usersMediumPieChart = new CanvasJS.Chart("users-medium-pie-chart", {
                animationDuration: 800,
                animationEnabled: true,
                backgroundColor: "transparent",
                colorSet: "customColorSet",
                legend: {
                    fontFamily: "calibri",
                    fontSize: 14,
                    horizontalAlign: "left",
                    verticalAlign: "center",
                    itemTextFormatter: function (e) {
                        return (
                            e.dataPoint.name +
                            ": " +
                            Math.round((e.dataPoint.y / totalServices) * 100) +
                            "%"
                        );
                    },
                },
                toolTip: {
                    cornerRadius: 0,
                    fontStyle: "normal",
                    contentFormatter: function (e) {
                        return (
                            e.entries[0].dataPoint.name +
                            ": " +
                            Math.round((e.entries[0].dataPoint.y / totalServices) * 100) +
                            "% (" +
                            e.entries[0].dataPoint.y +
                            ")"
                        );
                    },
                },
                data: [
                    {
                        legendMarkerType: "square",
                        radius: "90%",
                        showInLegend: true,
                        startAngle: 90,
                        type: "pie",
                        dataPoints: graphData,
                    },
                ],
            });

            var teachersPieChart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                exportEnabled: true,
                animationEnabled: true,
                data: [{
                    type: "pie",
                    startAngle: 25,
                    toolTipContent: "<b>{label}</b>{y}%",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label}  {y}%",
                    dataPoints: teacherDataPoints,
                }],
            });

            usersMediumPieChart.render();
            teachersPieChart.render();
        }

    </script>
    <script src="Contenu/js/conf.js"></script>


    <?php require "view_end.php"; ?>