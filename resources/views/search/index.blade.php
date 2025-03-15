<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Tìm kiếm sản phẩm</h1>
        <input type="text" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm...">
        <ul id="autocomplete-results" class="list-group mt-2"></ul>
    </div>

    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                const query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('autocomplete') }}",
                        type: "GET",
                        data: { query: query },
                        success: function(data) {
                            let results = '';
                            data.forEach(product => {
                                results += `<li class="list-group-item">
                                    <a href="/product/${product.id}">${product.name}</a>
                                </li>`;
                            });
                            $('#autocomplete-results').html(results);
                        }
                    });
                } else {
                    $('#autocomplete-results').html('');
                }
            });
        });
    </script>
</body>
</html>
