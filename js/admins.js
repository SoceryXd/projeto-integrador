
function saveTheme() {
    const selectedTheme = document.querySelector('input[name="theme"]:checked').value;
    alert(`Tema "${selectedTheme}" foi salvo!`);


    localStorage.setItem("siteTheme", selectedTheme);

    
    document.body.className = selectedTheme;
}


function saveStoreInfo() {
    const storeName = document.getElementById("storeName").value;
    const storeEmail = document.getElementById("storeEmail").value;
    const storePhone = document.getElementById("storePhone").value;

    alert("Informações da loja salvas com sucesso!");
    console.log({ storeName, storeEmail, storePhone });


}


function resetAdminPassword() {
    const confirmReset = confirm("Deseja redefinir a senha do administrador?");

    if (confirmReset) {
        alert("E-mail para redefinição de senha enviado.");
        
    }
}
