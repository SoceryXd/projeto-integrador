
const products = [
    { id: 1, name: 'Monitor Gamer', price: 1200.00, image: 'img/produto2.jpg' },
    { id: 2, name: 'Teclado Mecânico', price: 300.00, image:'img/produto3.jpg' },
    { id: 3, name: 'Headset Gamer', price: 250.00, image:'img/produto1.jpg' },
];


function addToCart(productId) {
    const product = products.find(p => p.id === productId);

    if (!product) return;

    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const existingItem = cartItems.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity++;
    } else {
        cartItems.push({ ...product, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cartItems));
    alert('Produto adicionado ao carrinho!');
}
