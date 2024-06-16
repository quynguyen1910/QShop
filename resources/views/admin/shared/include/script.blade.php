  <!-- Mainly scripts -->
<script src="/src/js/jquery-3.1.1.min.js"></script>
<script src="/src/js/bootstrap.min.js"></script>
<script src="/src/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/src/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
{{-- <script src="/src/js/plugins/flot/jquery.flot.js"></script>
<script src="/src/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/src/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="/src/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="/src/js/plugins/flot/jquery.flot.pie.js"></script> --}}

<!-- Peity -->
{{-- <script src="/src/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/src/js/demo/peity-demo.js"></script> --}}

<!--Nút ấn navbar và load trang -->
<script src="/src/js/inspinia.js"></script>
<script src="/src/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="/src/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
{{-- <script src="/src/js/plugins/gritter/jquery.gritter.min.js"></script> --}}

<!-- Sparkline -->
{{-- <script src="/src/js/plugins/sparkline/jquery.sparkline.min.js"></script> --}}

<!-- Sparkline demo data  -->
{{-- <script src="/src/js/demo/sparkline-demo.js"></script> --}}

<!-- ChartJS-->
{{-- <script src="/src/js/plugins/chartJs/Chart.min.js"></script> --}}

<!-- Toastr -->
{{-- <script src="/src/js/plugins/toastr/toastr.min.js"></script> --}}


  {{-- <script>
      $(document).ready(function() {
          setTimeout(function() {
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'slideDown',
                  timeOut: 4000
              };
              toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');

          }, 1300);


          var data1 = [
              [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
          ];
          var data2 = [
              [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
          ];
          $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
              data1, data2
          ],
                  {
                      series: {
                          lines: {
                              show: false,
                              fill: true
                          },
                          splines: {
                              show: true,
                              tension: 0.4,
                              lineWidth: 1,
                              fill: 0.4
                          },
                          points: {
                              radius: 0,
                              show: true
                          },
                          shadowSize: 2
                      },
                      grid: {
                          hoverable: true,
                          clickable: true,
                          tickColor: "#d5d5d5",
                          borderWidth: 1,
                          color: '#d5d5d5'
                      },
                      colors: ["#1ab394", "#1C84C6"],
                      xaxis:{
                      },
                      yaxis: {
                          ticks: 4
                      },
                      tooltip: false
                  }
          );

          var doughnutData = {
              labels: ["App","Software","Laptop" ],
              datasets: [{
                  data: [300,50,100],
                  backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
              }]
          } ;


          var doughnutOptions = {
              responsive: false,
              legend: {
                  display: false
              }
          };


          var ctx4 = document.getElementById("doughnutChart").getContext("2d");
          new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

          var doughnutData = {
              labels: ["App","Software","Laptop" ],
              datasets: [{
                  data: [70,27,85],
                  backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
              }]
          } ;


          var doughnutOptions = {
              responsive: false,
              legend: {
                  display: false
              }
          };


          var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
          new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

      });
  </script> --}}



  {{-- nút hành động và message Alert --}}
  <script>
    // Sử dụng jQuery(document).ready để đảm bảo DOM đã sẵn sàng
  jQuery(document).ready(function($) {
    // Sử dụng setTimeout để đợi 2 giây, sau đó ẩn thông báo success
    setTimeout(function() {
        $('#alert-fadeout').fadeOut('slow'); // Sử dụng class alert, bạn có thể thay đổi tùy theo cấu trúc của bạn
    }, 1000); // 2000 milliseconds = 2 giây


    $('#requestModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var action = button.data('action'); // Get the data-action attribute value
    var name = button.data('name'); 

    // Find the <a> tag inside modal-footer and set its href attribute
        var modal = $(this);
    modal.find('.modal-body').html(`<p>Tên người dùng: <span class="text-danger fw-bold">${name}</span> </p>`);

    $('#confirmDelete').on('click', function () {
        // Tạo form để submit
        var form = $('<form>', {
            'method': 'POST', // Đổi thành 'DELETE' nếu server hỗ trợ DELETE
            'action': action
        }).append('<input type="hidden" name="_method" value="DELETE">') // Đối với Laravel, sử dụng _method để giả lập DELETE
          .append('<input type="hidden" name="_token" value="{{ csrf_token() }}">'); // Đối với Laravel, cần token CSRF

        // Thêm form vào body và submit
        $('body').append(form);
        form.submit();
    });
});
});
  </script>