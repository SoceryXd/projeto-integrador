
function searchUser() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const userRows = document.querySelectorAll("#userTableBody tr");

    userRows.forEach(row => {
        const userName = row.cells[1].textContent.toLowerCase();
        const userEmail = row.cells[2].textContent.toLowerCase();

        if (userName.includes(searchInput) || userEmail.includes(searchInput)) {
            row.style.display = ""; 
        } else {
            row.style.display = "none"; 
        }
    });
}


function editUser(userId) {
    alert(`Editar usuário com ID: ${userId}`);
    
}


function deleteUser(userId) {
    const confirmDelete = confirm(`Tem certeza que deseja excluir o usuário com ID: ${userId}?`);

    if (confirmDelete) {
        alert(`Usuário com ID ${userId} foi excluído.`);
    
    }
}
