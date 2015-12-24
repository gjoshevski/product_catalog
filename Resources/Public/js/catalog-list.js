function addToCart(product,) {

    $.ajax({
        url: "http://dev.tend.si/marting/catalogShop/index.php?id=16&type=113&tx_catalogshoppingcart_shoppingcart%5BproductVariant%5D=15&tx_catalogshoppingcart_shoppingcart%5Baction%5D=addToCart&tx_catalogshoppingcart_shoppingcart%5Bcontroller%5D=ShoppingCart&cHash=cbf40e7e8bebd94fc82951a26735ea11",
        context: document.body
    }).done(function () {
        $(this).addClass("done");
    });
}