document.addEventListener('DOMContentLoaded', function () {
  const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

  addToCartButtons.forEach(button => {
    button.addEventListener('click', function () {
      const itemId = button.getAttribute('data-id');
      const quantity = parseInt(document.getElementById('quantity' + itemId).value);
      if (cartItems[itemId]) {
        cartItems[itemId] += quantity;
      } else {
        cartItems[itemId] = quantity;
      }
      updateCartIcon(cartItems);
    });
  });

  function updateCartIcon(cartItems) {
    const cartNotification = document.getElementById('cart-notification');
    const itemCount = Object.values(cartItems).reduce((total, count) => total + count, 0);
    cartNotification.textContent = itemCount;
  }
});

function openCartPage() {
  // Redirecione para a página de pedidos e passe os itens do carrinho como parâmetros
  const cartItemsString = JSON.stringify(cartItems);

  window.location.href = 'pedidos.php?items=' + cartItemsString;
}

function openNav() {
  const sideNav = document.getElementById("mySidenav");
  const mainContent = document.getElementById("main");

  if (sideNav.style.width === "250px") {
    sideNav.style.width = "0";
    mainContent.style.marginLeft = "0";
  } else {
    sideNav.style.width = "250px";
    mainContent.style.marginLeft = "250px";
  }
}

function closeNav() {
  const sideNav = document.getElementById("mySidenav");
  const mainContent = document.getElementById("main");

  sideNav.style.width = "0";
  mainContent.style.marginLeft = "0";
}
