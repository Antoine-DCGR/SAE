$(function () {
  var totalRevenue = 2781450,
    totalVisitors = 883000;

  // Données pour les graphiques de forage
  var dataMonthlyRevenueByCategory = {
    CDI: {
      color: "#717171",
      markerSize: 0,
      name: "CDI",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 20.5 },
        { x: new Date("1 Feb 2021"), y: 23.0 },
        { x: new Date("1 Mar 2021"), y: 29.0 },
        { x: new Date("1 Apr 2021"), y: 20.0 },
        { x: new Date("1 May 2022"), y: 36.0 },
        { x: new Date("1 Jun 2022"), y: 30.0 },
        { x: new Date("1 Jul 2022"), y: 28.0 },
        { x: new Date("1 Aug 2023"), y: 30.0 },
        { x: new Date("1 Sep 2023"), y: 25.0 },
        { x: new Date("1 Oct 2023"), y: 21.0 },
        { x: new Date("1 Nov 2024"), y: 30.0 },
        { x: new Date("1 Dec 2024"), y: 37.0 },
      ],
    },
    VAC: {
      color: "#e5d8b0",
      markerSize: 0,
      name: "VAC",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 19.5 },
        { x: new Date("1 Feb 2021"), y: 15.0 },
        { x: new Date("1 Mar 2021"), y: 34.0 },
        { x: new Date("1 Apr 2021"), y: 24.0 },
        { x: new Date("1 May 2022"), y: 31.0 },
        { x: new Date("1 Jun 2022"), y: 26.0 },
        { x: new Date("1 Jul 2022"), y: 23.0 },
        { x: new Date("1 Aug 2023"), y: 36.0 },
        { x: new Date("1 Sep 2023"), y: 30.0 },
        { x: new Date("1 Oct 2023"), y: 26.0 },
        { x: new Date("1 Nov 2024"), y: 36.0 },
        { x: new Date("1 Dec 2024"), y: 43.0 },
      ],
    },
    PR: {
      color: "#ffb367",
      markerSize: 0,
      name: "PR",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 41.0 },
        { x: new Date("1 Feb 2021"), y: 41.0 },
        { x: new Date("1 Mar 2021"), y: 42.0 },
        { x: new Date("1 Apr 2021"), y: 37.0 },
        { x: new Date("1 May 2022"), y: 36.0 },
        { x: new Date("1 Jun 2022"), y: 44.0 },
        { x: new Date("1 Jul 2022"), y: 38.0 },
        { x: new Date("1 Aug 2023"), y: 36.0 },
        { x: new Date("1 Sep 2023"), y: 50.0 },
        { x: new Date("1 Oct 2023"), y: 63.0 },
        { x: new Date("1 Nov 2024"), y: 56.0 },
        { x: new Date("1 Dec 2024"), y: 65.0 },
      ],
    },
    ESAS: {
      color: "#f98461",
      markerSize: 0,
      name: "ESAS",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 17.0 },
        { x: new Date("1 Feb 2021"), y: 27.0 },
        { x: new Date("1 Mar 2021"), y: 25.0 },
        { x: new Date("1 Apr 2021"), y: 16.0 },
        { x: new Date("1 May 2022"), y: 13.0 },
        { x: new Date("1 Jun 2022"), y: 17.0 },
        { x: new Date("1 Jul 2022"), y: 23.0 },
        { x: new Date("1 Aug 2023"), y: 15.0 },
        { x: new Date("1 Sep 2023"), y: 25.0 },
        { x: new Date("1 Oct 2023"), y: 21.0 },
        { x: new Date("1 Nov 2024"), y: 15.0 },
        { x: new Date("1 Dec 2024"), y: 10.0 },
      ],
    },
    MCF: {
      color: "#393f63",
      markerSize: 0,
      name: "MCF",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 69.0 },
        { x: new Date("1 Feb 2021"), y: 87.0 },
        { x: new Date("1 Mar 2021"), y: 81.0 },
        { x: new Date("1 Apr 2021"), y: 10.0 },
        { x: new Date("1 May 2022"), y: 10.0 },
        { x: new Date("1 Jun 2022"), y: 10.0 },
        { x: new Date("1 Jul 2022"), y: 12.0 },
        { x: new Date("1 Aug 2023"), y: 13.0 },
        { x: new Date("1 Sep 2023"), y: 12.0 },
        { x: new Date("1 Oct 2023"), y: 13.0 },
        { x: new Date("1 Nov 2024"), y: 11.0 },
        { x: new Date("1 Dec 2024"), y: 11.0 },
      ],
    },
    PAST: {
      color: "#d9695f",
      markerSize: 0,
      name: "PAST",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 79.0 },
        { x: new Date("1 Feb 2021"), y: 97.0 },
        { x: new Date("1 Mar 2021"), y: 10.0 },
        { x: new Date("1 Apr 2021"), y: 11.0 },
        { x: new Date("1 May 2022"), y: 11.0 },
        { x: new Date("1 Jun 2022"), y: 11.0 },
        { x: new Date("1 Jul 2022"), y: 13.0 },
        { x: new Date("1 Aug 2023"), y: 23.0 },
        { x: new Date("1 Sep 2023"), y: 22.0 },
        { x: new Date("1 Oct 2023"), y: 23.0 },
        { x: new Date("1 Nov 2024"), y: 21.0 },
        { x: new Date("1 Dec 2024"), y: 21.0 },
      ],
    },
    ATER: {
      color: "#a2a2a2",
      markerSize: 0,
      name: "ATER",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 69.0 },
        { x: new Date("1 Feb 2021"), y: 87.0 },
        { x: new Date("1 Mar 2021"), y: 81.0 },
        { x: new Date("1 Apr 2021"), y: 10.0 },
        { x: new Date("1 May 2022"), y: 10.0 },
        { x: new Date("1 Jun 2022"), y: 10.0 },
        { x: new Date("1 Jul 2022"), y: 12.0 },
        { x: new Date("1 Aug 2023"), y: 13.0 },
        { x: new Date("1 Sep 2023"), y: 12.0 },
        { x: new Date("1 Oct 2023"), y: 13.0 },
        { x: new Date("1 Nov 2024"), y: 11.0 },
        { x: new Date("1 Dec 2024"), y: 11.0 },
      ],
    },
    DOC: {
      color: "#FDE200",
      markerSize: 0,
      name: "DOC",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 69.0 },
        { x: new Date("1 Feb 2021"), y: 87.0 },
        { x: new Date("1 Mar 2021"), y: 81.0 },
        { x: new Date("1 Apr 2021"), y: 10.0 },
        { x: new Date("1 May 2022"), y: 10.0 },
        { x: new Date("1 Jun 2022"), y: 10.0 },
        { x: new Date("1 Jul 2022"), y: 12.0 },
        { x: new Date("1 Aug 2023"), y: 13.0 },
        { x: new Date("1 Sep 2023"), y: 12.0 },
        { x: new Date("1 Oct 2023"), y: 13.0 },
        { x: new Date("1 Nov 2024"), y: 11.0 },
        { x: new Date("1 Dec 2024"), y: 11.0 },
      ],
    },
    CDD: {
      color: "#E12424",
      markerSize: 0,
      name: "CDD",
      type: "column",
      yValueFormatString: "$###,###.00",
      dataPoints: [
        { x: new Date("1 Jan 2021"), y: 69.0 },
        { x: new Date("1 Feb 2021"), y: 87.0 },
        { x: new Date("1 Mar 2021"), y: 81.0 },
        { x: new Date("1 Apr 2021"), y: 10.0 },
        { x: new Date("1 May 2022"), y: 10.0 },
        { x: new Date("1 Jun 2022"), y: 10.0 },
        { x: new Date("1 Jul 2022"), y: 12.0 },
        { x: new Date("1 Aug 2023"), y: 13.0 },
        { x: new Date("1 Sep 2023"), y: 12.0 },
        { x: new Date("1 Oct 2023"), y: 13.0 },
        { x: new Date("1 Nov 2024"), y: 11.0 },
        { x: new Date("1 Dec 2024"), y: 11.0 },
      ],
    },
  };
  // data for drilldown charts
  var dataVisitors = {
    "New vs Returning Visitors": [
      {
        click: visitorsChartDrilldownHandler,
        cursor: "pointer",
        explodeOnClick: false,
        innerRadius: "75%",
        legendMarkerType: "square",
        name: "New vs Returning Visitors",
        radius: "100%",
        showInLegend: true,
        startAngle: 90,
        type: "doughnut",
        dataPoints: [
          { y: 519960, name: "COMP", color: "#393f63" },
          { y: 363040, name: " STAT", color: "#f98461" },
        ],
      },
    ],
    "New Visitors": [
      {
        color: "#393f63",
        name: "New Visitors",
        type: "column",
        dataPoints: [
          { x: new Date("1 Jan 2015"), y: 33000 },
          { x: new Date("1 Feb 2015"), y: 35960 },
          { x: new Date("1 Mar 2015"), y: 42160 },
          { x: new Date("1 Apr 2015"), y: 42240 },
          { x: new Date("1 May 2015"), y: 43200 },
          { x: new Date("1 Jun 2015"), y: 40600 },
          { x: new Date("1 Jul 2015"), y: 42560 },
          { x: new Date("1 Aug 2015"), y: 44280 },
          { x: new Date("1 Sep 2015"), y: 44800 },
          { x: new Date("1 Oct 2015"), y: 48720 },
          { x: new Date("1 Nov 2015"), y: 50840 },
          { x: new Date("1 Dec 2015"), y: 51600 },
        ],
      },
    ],
    "Returning Visitors": [
      {
        color: "#f98461",
        name: "Returning Visitors",
        type: "column",
        dataPoints: [
          { x: new Date("1 Jan 2015"), y: 22000 },
          { x: new Date("1 Feb 2015"), y: 26040 },
          { x: new Date("1 Mar 2015"), y: 25840 },
          { x: new Date("1 Apr 2015"), y: 23760 },
          { x: new Date("1 May 2015"), y: 28800 },
          { x: new Date("1 Jun 2015"), y: 29400 },
          { x: new Date("1 Jul 2015"), y: 33440 },
          { x: new Date("1 Aug 2015"), y: 37720 },
          { x: new Date("1 Sep 2015"), y: 35200 },
          { x: new Date("1 Oct 2015"), y: 35280 },
          { x: new Date("1 Nov 2015"), y: 31160 },
          { x: new Date("1 Dec 2015"), y: 34400 },
        ],
      },
    ],
  };
  var categoryColors = [
    "#393f63",
    "#FDE200",
    "#e5d8b0",
    "#717171",
    "#E12424",
    "#f98461",
    "#ffb367",
    "#d9695f",
    "#a2a2a2",
  ];
  // CanvasJS pie chart to show annual revenue by category
  var annualRevenueByCategoryPieChart = new CanvasJS.Chart(
    "annual-revenue-by-category-pie-chart",
    {
      animationEnabled: true,
      backgroundColor: "transparent",
      legend: {
        fontFamily: "calibri",
        fontSize: 14,
        horizontalAlign: "left",
        verticalAlign: "center",
        itemTextFormatter: function (e) {
          return (
            e.dataPoint.name +
            ": " +
            Math.round((e.dataPoint.y / totalRevenue) * 100) +
            "%"
          );
        },
      },
      toolTip: {
        backgroundColor: "#ffffff",
        cornerRadius: 0,
        fontStyle: "normal",
        contentFormatter: function (e) {
          return (
            e.entries[0].dataPoint.name +
            ": " +
            CanvasJS.formatNumber(e.entries[0].dataPoint.y, "###,###.00") +
            "%"
          );
        },
      },
      data: [
        {
          click: monthlyRevenueByCategoryDrilldownHandler,
          cursor: "pointer",
          legendMarkerType: "square",
          showInLegend: true,
          startAngle: 90,
          type: "pie",
          dataPoints: teacherStatisticsIUT.map(function (point, index) {
            return {
              y: point.y,
              name: point.name,
              legendText: point.name + ": " + point.y.toFixed(2) + "%",
              color: categoryColors[index], // Utilisez la couleur correspondante
            };
          }),
        },
      ],
    }
  );
  // Log colors to the console for debugging
  console.log(
    "Pie Chart Colors:",
    teacherStatisticsIUT.map((point) => point.color)
  );
  console.log(
    "Column Chart Colors:",
    Object.values(dataMonthlyRevenueByCategory).map(
      (categoryData) => categoryData.color
    )
  );

  var monthlyRevenueByCategoryColumnChart = new CanvasJS.Chart(
    "monthly-revenue-by-category-column-chart",
    {
      animationEnabled: true,
      backgroundColor: "transparent",
      axisX: {
        interval: 2,
        intervalType: "month",
        labelFontColor: "#717171",
        lineColor: "#a2a2a2",
        tickColor: "#a2a2a2",
      },
      axisY: {
        gridThickness: 0,
        labelFontColor: "#717171",
        lineColor: "#a2a2a2",
        maximum: 100, // Maximum set to 100 for percentage
        suffix: "%", // Suffix for displaying percentage
        tickColor: "#a2a2a2",
      },
      toolTip: {
        backgroundColor: "#737580",
        borderThickness: 0,
        cornerRadius: 0,
        fontColor: "#ffffff",
        fontSize: 16,
        fontStyle: "normal",
        shared: true,
        contentFormatter: function (e) {
          // Formatting tooltip to show percentage
          return e.entries
            .map(
              (entry) =>
                `${entry.dataSeries.name}: ${entry.dataPoint.y.toFixed(2)}%`
            )
            .join("<br/>");
        },
      },
      data: teacherStatisticsIUT.map(function (point, index) {
        return {
          type: "column",
          showInLegend: true,
          legendMarkerColor: categoryColors[index], // Utilisez la couleur correspondante
          legendText: point.name,
          dataPoints: [],
        };
      }), // Make sure data points are percentages
    }
  );

  // var annualRevenueByCategoryPieChart = new CanvasJS.Chart(
  //   "annual-revenue-by-category-pie-chart",
  //   {
  //     animationEnabled: true,
  //     backgroundColor: "transparent",
  //     legend: {
  //       fontFamily: "calibri",
  //       fontSize: 14,
  //       horizontalAlign: "left",
  //       verticalAlign: "center",
  //       itemTextFormatter: function (e) {
  //         return (
  //           e.dataPoint.name +
  //           ": " +
  //           Math.round((e.dataPoint.y / totalRevenue) * 100) +
  //           "%"
  //         );
  //       },
  //     },
  //     toolTip: {
  //       backgroundColor: "#ffffff",
  //       cornerRadius: 0,
  //       fontStyle: "normal",
  //       contentFormatter: function (e) {
  //         return (
  //           e.entries[0].dataPoint.name +
  //           ": " +
  //           CanvasJS.formatNumber(e.entries[0].dataPoint.y, "$###,###.00") +
  //           " - " +
  //           Math.round((e.entries[0].dataPoint.y / totalRevenue) * 100) +
  //           "%"
  //         );
  //       },
  //     },
  //     data: [
  //       {
  //         click: monthlyRevenueByCategoryDrilldownHandler,
  //         cursor: "pointer",
  //         legendMarkerType: "square",
  //         showInLegend: true,
  //         startAngle: 90,
  //         type: "pie",
  //         dataPoints: teacherStatisticsIUT,
  //       },
  //     ],
  //   }
  // );

  // var monthlyRevenueByCategoryColumnChart = new CanvasJS.Chart(
  //   "monthly-revenue-by-category-column-chart",
  //   {
  //     animationEnabled: true,
  //     backgroundColor: "transparent",
  //     axisX: {
  //       interval: 2,
  //       intervalType: "month",
  //       labelFontColor: "#717171",
  //       lineColor: "#a2a2a2",
  //       tickColor: "#a2a2a2",
  //     },
  //     axisY: {
  //       gridThickness: 0,
  //       labelFontColor: "#717171",
  //       lineColor: "#a2a2a2",
  //       maximum: 100, // Maximum set to 100 for percentage
  //       suffix: "%", // Suffix for displaying percentage
  //       tickColor: "#a2a2a2",
  //     },
  //     toolTip: {
  //       backgroundColor: "#737580",
  //       borderThickness: 0,
  //       cornerRadius: 0,
  //       fontColor: "#ffffff",
  //       fontSize: 16,
  //       fontStyle: "normal",
  //       shared: true,
  //       contentFormatter: function (e) {
  //         // Formatting tooltip to show percentage
  //         return e.entries
  //           .map((entry) => `${entry.dataSeries.name}: ${entry.dataPoint.y}%`)
  //           .join("<br/>");
  //       },
  //     },
  //     data: array_values(dataMonthlyRevenueByCategory),
  //   }
  // );

  populateMonthlyRevenueByCategoryChart();
  monthlyRevenueByCategoryColumnChart.render();

  var visitorsDrilldownedChartOptions = {
    animationEnabled: true,
    backgroundColor: "transparent",
    axisX: {
      labelFontColor: "#717171",
      lineColor: "#a2a2a2",
      tickColor: "#a2a2a2",
    },
    axisY: {
      gridThickness: 0,
      includeZero: false,
      labelFontColor: "#717171",
      lineColor: "#a2a2a2",
      tickColor: "#a2a2a2",
    },
    toolTip: {
      cornerRadius: 0,
      fontStyle: "normal",
    },
    data: [],
  };

  var newVsReturningVisitorsChartOptions = {
    animationEnabled: true,
    backgroundColor: "transparent",
    legend: {
      fontFamily: "calibri",
      fontSize: 14,
      itemTextFormatter: function (e) {
        return (
          e.dataPoint.name +
          ": " +
          Math.round((e.dataPoint.y / totalVisitors) * 100) +
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
          CanvasJS.formatNumber(e.entries[0].dataPoint.y, "###,###") +
          " - " +
          Math.round((e.entries[0].dataPoint.y / totalVisitors) * 100) +
          "%"
        );
      },
    },
    data: [],
  };

  //----------------------------------------------------------------------------------//
  var allCharts = [
    annualRevenueByCategoryPieChart,
    monthlyRevenueByCategoryColumnChart,
  ];

  function populateMonthlyRevenueByCategoryChart() {
    for (var prop in dataMonthlyRevenueByCategory)
      if (dataMonthlyRevenueByCategory.hasOwnProperty(prop))
        monthlyRevenueByCategoryColumnChart.options.data.push(
          dataMonthlyRevenueByCategory[prop]
        );
  }

  function monthlyRevenueByCategoryDrilldownHandler(e) {
    monthlyRevenueByCategoryColumnChart.options.data = [];

    for (
      var i = 0;
      i < annualRevenueByCategoryPieChart.options.data[0].dataPoints.length;
      i++
    )
      if (
        annualRevenueByCategoryPieChart.options.data[0].dataPoints[i]
          .exploded === true
      )
        monthlyRevenueByCategoryColumnChart.options.data.push(
          dataMonthlyRevenueByCategory[
            annualRevenueByCategoryPieChart.options.data[0].dataPoints[i].name
          ]
        );

    if (monthlyRevenueByCategoryColumnChart.options.data.length === 0)
      populateMonthlyRevenueByCategoryChart();

    monthlyRevenueByCategoryColumnChart.render();
  }

  function visitorsChartDrilldownHandler(e) {
    visitorsChart = new CanvasJS.Chart(
      "visitors-chart",
      visitorsDrilldownedChartOptions
    );
    visitorsChart.options.data = dataVisitors[e.dataPoint.name];
    visitorsChart.render();
  }

  // chart properties cutomized further based on screen width
  function chartPropertiesCustomization() {
    if ($(window).outerWidth() >= 1200) {
      annualRevenueByCategoryPieChart.options.legend.horizontalAlign = "left";
      annualRevenueByCategoryPieChart.options.legend.verticalAlign = "center";
      annualRevenueByCategoryPieChart.render();
    } else if ($(window).outerWidth() < 1200) {
      annualRevenueByCategoryPieChart.options.legend.horizontalAlign = "center";
      annualRevenueByCategoryPieChart.options.legend.verticalAlign = "top";
      annualRevenueByCategoryPieChart.render();
    }
  }

  function renderAllCharts() {
    for (var i = 0; i < allCharts.length; i++) allCharts[i].render();
  }

  function sidebarToggleOnClick() {
    $("#sidebar-toggle-button").on("click", function () {
      $("#sidebar").toggleClass("sidebar-toggle");
      $("#page-content-wrapper").toggleClass("page-content-toggle");
      renderAllCharts();
    });
  }

  (function init() {
    chartPropertiesCustomization();
    $(window).resize(chartPropertiesCustomization);
    sidebarToggleOnClick();
  })();
});
