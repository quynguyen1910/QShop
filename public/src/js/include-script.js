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