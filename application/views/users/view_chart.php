<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="page-wrapper">
  <!-- Main content -->
  <section class="container-fluid">

    <div class="row">
    <div class="col-md-12">
      <br>
      <?php if ($this->current_user_role == 1): ?>
        <a href="<?= base_url('user/ask_survey');?>" class="btn btn-info"> < Return to survey results</a>
        <?php else: ?>
        <a href="<?= base_url('user/show_survey');?>" class="btn btn-info"> < Return to survey results</a>
      <?php endif ?>
        <canvas id="mycanvas" max-width="300" max-height="300"></canvas>
      
    </div>
  


    </div>
  </section>
</div>


<script>
$(document).ready(function(){
  $.ajax({
    url: "<?php echo site_url('user/get_chart_data')?>",
    method: "GET",
    success: function(data) {
                              console.log(data);
                              var score = [];
                              for(var i in data) {
                                score.push(data[i]);
                            }
      var chartdata = {
              datasets : [
                {
                  label: 'Player Score',
                  data: score,
             backgroundColor: [
                'rgba(55, 99, 132,0.2)',
                'rgba(54, 162, 235, 0.2)',
 
            ],
            borderColor: [
                'rgba(55, 99, 132,0.2)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 2

                }
              ],
              labels: ["No","Yes"],
            };


      

var options = {
    responsive: true,
    title: {
        display: true,
        position: "top",
        text: "Results",
        fontSize: 18,
        fontColor: "#f46f36"
    },
    legend: {
        display: true,
        position: "bottom",
        labels: {
            fontColor: "#333",
            fontSize: 16
        }
    }
};

      var ctx = $("#mycanvas"); // calling canvas id to display the chart

      var barGraph = new Chart(ctx, { // making object with ctx, type and chartdata
        type: 'pie',
        data: chartdata,
        options: options
      });

    },
    error: function(data) {
      console.log(data);
    }
  });
});


</script>