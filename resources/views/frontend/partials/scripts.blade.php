<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.6/lib/darkmode-js.min.js"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


<script>
    new Darkmode().showWidget();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addToCart(product_id) {
        var url = "{{ url('/') }}";
        $.post(url + "/api/cart/store", {
                product_id: product_id
            })
            .done(function (data) {
                data = JSON.parse(data);
                if (data.status == "success") {
                    // toast
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.success('Item added to cart successfully!Total Items: ' + data.totalItems +
                        '<br />To checkout <a href="cart/">Go to checkout page</a>');

                    console.log(data.totalItems);
                    $("#totalItems").html(data.totalItems);
                }
            });
    }

</script>
