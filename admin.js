$(document).ready(function() {
    function showTab(tabId) {
        $('.tab-content').removeClass('active');
        $(tabId).addClass('active');
    }

    $('#customers-link').click(function() {
        showTab('#customers');
    });

    $('#products-link').click(function() {
        showTab('#products');
    });

    $('#orders-link').click(function() {
        showTab('#orders');
    });

    $('#add-customer').click(function() {
        const customerId = $('#customer-id').val();
        const fullName = $('#full-name').val();
        const eMail = $('#e-mail').val();
        const phoneNumber = $('#phone-number').val();
        const addedDate = $('#added-date').val();
        const updateDate = $('#update-date').val();
        const adress = $('#adress').val();
        if (fullName && eMail && phoneNumber && addedDate && updateDate && adress && customerId) {
            const customerRow = `<tr>
                <td>${customerId}</td>
                <td>${fullName}</td>
                <td>${eMail}</td>
                <td>${phoneNumber}</td>
                <td>${addedDate}</td>
                <td>${updateDate}</td>
                <td>${adress}</td>
                <td class="buttons"><button class="delete-btn-customer">Sil</button> <button class="edit-btn-customer">Güncelle</button></td>
            </tr>`;
            $('#customer-items').append(customerRow);

            $('#customer-id').val('');
            $('#full-name').val('');
            $('#e-mail').val('');
            $('#phone-number').val('');
            $('#added-date').val('');
            $('#update-date').val('');
            $('#adress').val('');
        }
    });

    $(document).on('click', '#customer-items tr', function() {
        $('#customer-items tr').removeClass('satirhighlight');
        $(this).addClass('satirhighlight');
    });

    $(document).on('click', '.delete-btn-customer', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.edit-btn-customer', function() {
        const row = $(this).closest('tr');
        const cells = row.find('td').not('.buttons');
        if ($(this).text() === 'Güncelle') {
            // Verileri input alanlarına dönüştür
            cells.each(function() {
                const span = $(this).find('span');
                const value = span.text();
                $(this).html(`<input type="text" value="${value}" />`);
            });
            $(this).text('Kaydet');
        } else {
            // Verileri kaydet ve span elemanlarına dönüştür
            cells.each(function() {
                const input = $(this).find('input');
                const value = input.val();
                $(this).html(`<span>${value}</span>`);
            });
            $(this).text('Güncelle');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('#customer-items tr').length) {
            $('#customer-items tr').removeClass('satirhighlight');
        }
    });

    $('#add-product').click(function() {
        const productId = $('#product-id').val();
        const productName = $('#product-name').val();
        const category = $('#category').val();
        const productPrice = $('#product-price').val();
        const productAddedDate = $('#product-added-date').val();
        const productUpdateDate = $('#product-update-date').val();
        const photoPath = $('#photo-path').val();
        const details = $('#details').val();
        if (productId && productName && category && productPrice && productAddedDate && productUpdateDate && photoPath && details) {
            const productRow = `<tr>
                <td>${productId}</td>
                <td>${productName}</td>
                <td>${category}</td>
                <td>${productPrice}</td>
                <td>${productAddedDate}</td>
                <td>${productUpdateDate}</td>
                <td>${photoPath}</td>
                <td>${details}</td>
                <td class="buttons"><button class="delete-btn-product">Sil</button> <button class="edit-btn-product">Güncelle</button></td>
            </tr>`;
            $('#product-items').append(productRow);
    
            // Alanları temizle
            $('#product-id').val('');
            $('#product-name').val('');
            $('#category').val('');
            $('#product-price').val('');
            $('#product-added-date').val('');
            $('#product-update-date').val('');
            $('#photo-path').val('');
            $('#details').val('');
        } else {
            alert("Lütfen tüm alanları doldurun.");
        }
        
    });
    $(document).on('click', '#product-items tr', function() {
        $('#product-items tr').removeClass('satirhighlight');
        $(this).addClass('satirhighlight');
    });

    $(document).on('click', '.delete-btn-product', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.edit-btn-product', function() {
        const row = $(this).closest('tr');
        const cells = row.find('td').not('.buttons');
        if ($(this).text() === 'Güncelle') {
            // Verileri input alanlarına dönüştür
            cells.each(function() {
                const span = $(this).find('span');
                const value = span.text();
                $(this).html(`<input type="text" value="${value}" />`);
            });
            $(this).text('Kaydet');
        } else {
            // Verileri kaydet ve span elemanlarına dönüştür
            cells.each(function() {
                const input = $(this).find('input');
                const value = input.val();
                $(this).html(`<span>${value}</span>`);
            });
            $(this).text('Güncelle');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('#cart-items tr').length) {
            $('#cart-items tr').removeClass('satirhighlight');
        }
    });


    $('#add-order').click(function() {
        const orderNo = $('#order-no').val();
        const orderCustomerId = $('#order-customer-id').val();
        const orderDate = $('#order-date').val();
        const paymentMethod = $('#payment-method').val();
        const price = $('#price').val();
        if (orderNo && orderCustomerId ) {
            const orderRow = `<tr>
                <td>${orderNo}</td>
                <td>Hazırlanıyor.</td>
                <td>${orderCustomerId}</td>
                <td>${orderDate}</td>
                <td>${paymentMethod}</td>
                <td>${price}</td>
                <td class="buttons"><button class="delete-btn">Sil</button> <button class="edit-btn">Güncelle</button></td>
            </tr>`;
            $('#cart-items').append(orderRow);

            $('#order-no').val('');
            $('#order-customer-id').val('');
            $('#order-date').val('');
            $('#payment-method').val('');
            $('#price').val('');
        }else {
            alert("Lütfen tüm alanları doldurun.");
        }
    });

    $(document).on('click', '#cart-items tr', function() {
        $('#cart-items tr').removeClass('satirhighlight');
        $(this).addClass('satirhighlight');
    });

    $(document).on('click', '.delete-btn', function() {
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.edit-btn', function() {
        const row = $(this).closest('tr');
        const cells = row.find('td').not('.buttons');
        if ($(this).text() === 'Güncelle') {
            // Verileri input alanlarına dönüştür
            cells.each(function() {
                const span = $(this).find('span');
                const value = span.text();
                $(this).html(`<input type="text" value="${value}" />`);
            });
            $(this).text('Kaydet');
        } else {
            // Verileri kaydet ve span elemanlarına dönüştür
            cells.each(function() {
                const input = $(this).find('input');
                const value = input.val();
                $(this).html(`<span>${value}</span>`);
            });
            $(this).text('Güncelle');
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('#cart-items tr').length) {
            $('#cart-items tr').removeClass('satirhighlight');
        }
    });

});