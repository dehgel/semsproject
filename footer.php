<?php

/**
 * Smart Energy Metering System 
 * Data distributions to logged-in user (the electrical consumer) to monitor balance, usage, and year-round consumptions in real-time
 * 
 * @author Deh Saaduddin
 * @package SEMS
 * @version 1.1
 * 
 */
$userid = $_SESSION['user_id'];
?>
  <!-- Main Footer -->
  <footer class="main-footer">
      
    <strong>Copyright &copy; 2023 <a href="https://msu-main.edu.ph">msu-main.edu.ph</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="dist/js/pages/script.js"></script>
<script>
$(document).ready((function(){setTimeout((function(){$(".preloader-container").fadeOut()}),3e3)}));
</script>
<script>
$(document).ready((function(){const n=$("#preloader");$(window).on("load",(function(){n.css("opacity",0),setTimeout((function(){n.css("display","none")}),300)}))}));
</script>
<script>
const idFromApi = fetchIdFromApi()[0];
const url = window.location.href;

if (url.includes("/consumer.php")) {
    $(document).ready(function () {
        var t, a, e;
        $.ajax({
            url: "/api/data.php",
            type: "GET",
            dataType: "json",
            success: function (r) {
                var o = r.ID,
                    l = r.USERNAME,
                    s = r.EMAIL;
                    t = r.FIRSTNAME;
                    a = r.MIDDLENAME;
                    e = r.FAMILYNAME;

                var n = r.ADDRESS,
                    c = r.VOLT_AVG,
                    i = r.CURR,
                    d = r.KWUSED,
                    f = r.TO_PF,
                    lastPaid = r.LAST_PAID;

                $("#username").text(l);
                $("#emailadd").text(s);
                $("#accountid").text(o);
                $("#cname").text(e + ", " + t + " " + a);
                $("#address").text(n);
                $("#prevpayment").text(lastPaid);
            },
            error: function (t, a, e) {
                console.error("Error", e);
            },
        });

        $.ajax({
            url: "/api/user.php",
            type: "GET",
            dataType: "json",
            success: function (r) {
                var o = r.ID,
                    l = r.USERNAME,
                    s = r.EMAIL;
                    t = r.FIRSTNAME;
                    a = r.MIDDLENAME;
                    e = r.FAMILYNAME;

                var n = r.ADDRESS,
                    c = r.VOLT_AVG,
                    i = r.CURR,
                    d = r.AMT,
                    kwhUsed = r.KWUSED;

                var pf = r.TO_PF,
                    lastPaid = r.LAST_PAID,
                    credits = r.CREDITS,
                    topay = r.TOPAY;

                if (topay <= 0) {
                    topay = "0.00";
                }

                if (kwhUsed <= 1e-12) {
                    kwhUsed = "0.00";
                }

                $("#username").text(l);
                $("#emailadd").text(s);
                $("#accountid").text(o);
                $("#cname").text(e + ", " + t + " " + a);
                $("#address").text(n);
                $("#balance").text("P " + (Number(topay) + Number(credits)));
                $("#kwc").text(kwhUsed + " kWh");
                $("#totalpaid").text("P " + d);
                $("#prevpayment").text(lastPaid);
            },
            error: function (t, a, e) {
                console.error("AJAX Error:", e);
            },
        });
    });

    $(document).ready(function () {
        var chartData = {
            labels: [],
            datasets: [
                {
                    label: "Voltage (V)",
                    borderColor: "rgb(75, 192, 192)",
                    data: [],
                    fill: false,
                },
                {
                    label: "Current (A)",
                    borderColor: "rgb(255, 99, 132)",
                    data: [],
                    fill: false,
                },
                {
                    label: "Power Factor",
                    borderColor: "rgb(255, 205, 86)",
                    data: [],
                    fill: false,
                },
                {
                    label: "kWh",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    data: [],
                    fill: true,
                },
            ],
        };

        var xAxisValue = parseInt(localStorage.getItem("xAxisValue")) || 1;
        var chartLabels = JSON.parse(localStorage.getItem("chartLabels")) || [];
        var chartDataValues = JSON.parse(localStorage.getItem("chartData")) || [];

        if (chartLabels.length > 0) {
            chartData.labels = chartLabels.slice(-10);
            chartData.datasets.forEach(function (dataset, index) {
                if (chartDataValues[index]) {
                    dataset.data = chartDataValues[index].slice(-10);
                }
            });
        }

        var ctx = document.getElementById("realtime-chart").getContext("2d");

        var lineChart = new Chart(ctx, {
            type: "line",
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    x: {
                        type: "linear",
                        position: "bottom",
                        max: 10,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });

        $("#resetButton").click(function () {
            chartData.labels = [];
            chartData.datasets.forEach(function (dataset) {
                dataset.data = [];
            });
            xAxisValue = 1;
            localStorage.setItem("xAxisValue", "1");
            localStorage.setItem("chartLabels", "[]");
            localStorage.setItem("chartData", "[]");
            lineChart.update();
        });

        var apiEndpoint = "api/dummy.php?uid=" + idFromApi;
        var previousData = null;

        setInterval(function () {
            $.ajax({
                url: apiEndpoint,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    if (
                        previousData === null ||
                        data.v !== previousData.v ||
                        data.c !== previousData.c ||
                        data.kwh !== previousData.kwh ||
                        data.pf !== previousData.pf
                    ) {
                        var voltage = data.v;
                        var current = data.c;
                        var kwhUsed = data.kwh;
                        var pf = data.pf;

                        $("#voltageValue").text(voltage + " V");
                        $("#currentValue").text(current + " A");
                        $("#kwhUsedValue").text(kwhUsed + " W");
                        $("#pfValue").text(pf);

                        function updateChartData(data) {
                            chartData.labels.push(xAxisValue);
                            chartData.datasets[0].data.push(data.v);
                            chartData.datasets[1].data.push(data.c);
                            chartData.datasets[2].data.push(data.pf);
                            chartData.datasets[3].data.push(data.kwh);
                            xAxisValue++;

                            if (chartData.labels.length > 20) {
                                chartData.labels.shift();
                                chartData.datasets.forEach(function (dataset) {
                                    dataset.data.shift();
                                });
                            }

                            lineChart.update();
                            localStorage.setItem("chartLabels", JSON.stringify(chartData.labels));

                            var chartDataValues = [];
                            chartData.datasets.forEach(function (dataset) {
                                chartDataValues.push(dataset.data);
                            });
                            localStorage.setItem("chartData", JSON.stringify(chartDataValues));
                        }

                        updateChartData(data);
                        previousData = data;
                    }
                },
                error: function (error) {
                    console.error("Error fetching data:", error);
                },
            });
        }, 3000);
    });
}
</script>
<script>
$.ajax({
    url: "admin/api/autodisconnect.php?connstate=" + idFromApi,
    type: "GET",
    dataType: "json",
    success: function (e) {
        if (e === null) {
            $(".top-left-value").text("New account");
            $(".top-right-value").text("New account");
            $(".bottom-left-value").text("New account");
            $(".bottom-right-value").text("New account");
        } else {
            e.CONSUMER_ID;
            var aa = e.DCONN,
                ss = aa == 1 ? aa + " day" : aa + " days";
                bb = aa > 90 ? "Overdue(" + aa + ")": ss,
                t = new Date(e.LPAY),
                o = new Date(e.TODAY),
                r = e.DAYDIFF,
                a = o.getMonth() - t.getMonth() + 12 * (o.getFullYear() - t.getFullYear()),
                n = (aa / 90) * 100;
                m = n > 100.00 ? "Ceiling(100.0%)" : n.toFixed(2) + "%";
                rday = Number(90)-Number(aa) < 0 ? "Floor(0)" : Number(90)-Number(aa) + " days";

            $(".top-left-value").text(bb);
            $(".top-right-value").text(rday);
            $(".bottom-left-value").text(a);
            $(".bottom-right-value").text(m);
        }
    },
    error: function (e, t, o) {
        // Comment out or remove the error logging to hide console errors
        // console.error("AJAX Error:", o);
    }
});
</script>


<!-- Bootstrap -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="admin/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="admin/plugins/sweetalert2/sweetalert2.all.js"></script>

<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="admin/plugins/chart.js/Chart.min.js"></script>
<script src="admin/plugins/fullcalendar/main.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>
