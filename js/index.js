function addToCart(productId) {
    fetch(`/add-to-cart.php?product_id=${productId}`, {
        method: 'GET'
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              alert('Produto adicionado ao carrinho!');
          }
      });
}
