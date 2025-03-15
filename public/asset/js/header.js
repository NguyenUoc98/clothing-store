$(document).ready(function () {
    const searchBox = $('#search-box'); // Sử dụng jQuery để chọn ô tìm kiếm
    const suggestionsList = $('.suggestions-list'); // Danh sách gợi ý
    const suggestionsWrapper = $('.suggestions-list-wrapper'); // Vùng chứa danh sách gợi ý

    // Khi người dùng nhập vào ô tìm kiếm, gửi yêu cầu AJAX
    searchBox.on('keyup', function () {
        let query = $(this).val();
        if (query.length > 1) { // Kiểm tra độ dài của từ khóa
            $.ajax({
                url: '{{ route("search") }}',
                type: 'GET',
                data: {
                    query: query
                },
                success: function (data) {
                    suggestionsList.empty(); // Xóa danh sách gợi ý cũ
                    data.forEach(product => {
                        suggestionsList.append(`<li onclick="viewProduct(${product.id})">${product.name}</li>`);
                    });
                    suggestionsList.addClass('show'); // Hiển thị danh sách gợi ý
                }
            });
        } else {
            suggestionsList.empty(); // Nếu không có từ khóa, xóa danh sách gợi ý
            suggestionsList.removeClass('show'); // Ẩn danh sách gợi ý
        }
    });

    // Khi người dùng nhấp vào bất kỳ đâu ngoài ô tìm kiếm hoặc danh sách gợi ý, ẩn danh sách gợi ý
    $(document).on('click', function (event) {
        if (!suggestionsWrapper.is(event.target) && !suggestionsWrapper.has(event.target).length && !searchBox.is(event.target)) {
            suggestionsList.removeClass('show'); // Ẩn danh sách gợi ý
        }
    });

    // Ngừng ẩn danh sách gợi ý khi người dùng nhấp vào ô tìm kiếm
    searchBox.on('click', function (event) {
        event.stopPropagation(); // Ngừng sự kiện 'click' để không bị ẩn
    });
});

// Hàm để chuyển hướng đến trang chi tiết sản phẩm
function viewProduct(id) {
    window.location.href = '/product/' + id; // Chuyển hướng đến trang chi tiết sản phẩm
}

// Hàm để chọn sản phẩm từ gợi ý
function selectProduct(name) {
    $('#search-box').val(name);
    $('.suggestions-list').empty();
    $('.suggestions-list').removeClass('show');
}