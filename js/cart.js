class CartItem {
    constructor(name, price, image, quantity = 1) {
        this.name = name;
        this.price = price;
        this.image = image;
        this.quantity = quantity;
    }

    get total() {
        return this.price * this.quantity;
    }
}

class Cart {
    static items = JSON.parse(localStorage.getItem("cart")) || [];

    static loadCart() {
        const cartItemsContainer = document.getElementById("cart-items");
        const cartTotal = document.getElementById("cart-total");
        cartItemsContainer.innerHTML = ""; // Limpa o conteúdo
        let total = 0;

        Cart.items.forEach((item, index) => {
            const cartItemElement = document.createElement("div");
            cartItemElement.classList.add("cart-item");
            cartItemElement.innerHTML = `
                <div class="cart-item-info">
                    <img src="${item.image}" alt="${item.name}">
                    <div>
                        <h4>${item.name}</h4>
                        <p>R$ ${item.price.toFixed(2)}</p>
                        <p>Quantidade: ${item.quantity}</p>
                    </div>
                </div>
                <div class="cart-item-actions">
                    <span>R$ ${item.total.toFixed(2)}</span>
                    <button onclick="Cart.removeItem(${index})">🗑️</button>
                </div>
            `;
            cartItemsContainer.appendChild(cartItemElement);
            total += item.total;
        });

        cartTotal.innerText = `R$ ${total.toFixed(2)}`;
    }

    static addItem(name, price, image) {
        const existingItem = Cart.items.find(item => item.name === name);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            Cart.items.push(new CartItem(name, price, image));
        }

        Cart.saveCart();
        Cart.loadCart();
        alert("Item adicionado ao carrinho!");
    }

    static removeItem(index) {
        Cart.items.splice(index, 1);
        Cart.saveCart();
        Cart.loadCart();
    }

    static saveCart() {
        localStorage.setItem("cart", JSON.stringify(Cart.items));
    }

    static checkout() {
        if (Cart.items.length === 0) {
            alert("Seu carrinho está vazio!");
            return;
        }
        
        if (confirm("Deseja finalizar a compra?")) {
            Cart.items = [];
            Cart.saveCart();
            Cart.loadCart();
            alert("Compra finalizada com sucesso!");
        }
    }
}

window.onload = Cart.loadCart;
