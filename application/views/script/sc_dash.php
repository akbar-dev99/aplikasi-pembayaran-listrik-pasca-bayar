<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("datetimepicker-dashboard").flatpickr({
      inline: true,
      prevArrow: "<span title=\"Previous month\">&laquo;</span>",
      nextArrow: "<span title=\"Next month\">&raquo;</span>",
      defaultDate: new Date()
    });
  });
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    let ctx = document.getElementById("usage-chart").getContext("2d");
    let gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    // Line chart
    new Chart(document.getElementById("usage-chart"), {
      type: "line",
      data: {
        labels: [<?php
                  foreach ($usage_grafik as $data) {
                    echo '"' . MonthToString($data->bulan) . ' ' . $data->tahun . '",';
                  }
                  ?>],
        datasets: [{
          label: "Jumlah Meter",
          fill: true,
          backgroundColor: gradient,
          borderColor: window.theme.primary,
          data: [
            <?php
            foreach ($usage_grafik as $data) {
              echo $data->total_pemakaian . ',';
            }

            ?>
          ]
        }]
      },
      options: {
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        tooltips: {
          intersect: false
        },
        hover: {
          intersect: true
        },
        plugins: {
          filler: {
            propagate: false
          }
        },
        scales: {
          xAxes: [{
            reverse: true,
            gridLines: {
              color: "rgba(0,0,0,0.0)"
            }
          }],
          yAxes: [{
            ticks: {
              stepSize: 1000
            },
            display: true,
            borderDash: [3, 3],
            gridLines: {
              color: "rgba(0,0,0,0.0)"
            }
          }]
        }
      }
    });
  });
</script>