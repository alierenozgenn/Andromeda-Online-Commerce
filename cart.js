$(document).ready(function() {
    function updateCart() {
        let cart = localStorage.getItem('cart');
        if (cart) {
            cart = JSON.parse(cart);
        } else {
            cart = [];
        }

        let total = 0;
        $('#cart-items').empty();
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            $('#cart-items').append(`
                <tr data-id="${item.id}">
                    <td><img src="${item.image}" alt="${item.name}"></td>
                    <td>${item.name}</td>
                    <td><input type="number" value="${item.quantity}" class="quantity"></td>
                    <td>${item.price} TL</td>
                    <td>${itemTotal} TL</td>
                    <td><button class="remove-btn">Sil</button></td>
                </tr>
            `);
        });
        $('#total-price').text(`${total} TL`);
    }

    $(document).on('click', '.remove-btn', function() {
        const id = $(this).closest('tr').data('id');
        let cart = JSON.parse(localStorage.getItem('cart'));
        const index = cart.findIndex(item => item.id === id);
        if (index !== -1) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }
    });

    $(document).on('change', '.quantity', function() {
        const id = $(this).closest('tr').data('id');
        let newQuantity = $(this).val();

        if (newQuantity < 1) {
            newQuantity = 1;
            $(this).val(1);
        }

        let cart = JSON.parse(localStorage.getItem('cart'));
        const item = cart.find(item => item.id === id);

        if (item) {
            item.quantity = parseInt(newQuantity);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }
    });

    $('.odemeYap').on('click', function() {
        const user_email = "user@example.com"; // Kullanıcının e-posta adresi
        const user_password = "password"; // Kullanıcının şifresi

        let cart = localStorage.getItem('cart');
        if (cart) {
            cart = JSON.parse(cart);
        } else {
            cart = [];
        }

        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

        $.ajax({
            url: 'save_order.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                items: cart,
                total: total,
                user_email: user_email,
                user_password: user_password
            }),
            success: function(response) {
                if (response.message) {
                    localStorage.removeItem('cart');
                    updateCart();
                    alert('Siparişiniz Onaylandı.');
                } else {
                    alert('Sipariş oluşturulurken bir hata oluştu: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                alert('Sipariş oluşturulurken bir hata oluştu: ' + error);
            }
        });
    });

    updateCart();
});
