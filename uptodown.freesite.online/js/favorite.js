// Lấy các phần tử
const linkName = document.getElementById("link-name");
const linkUrl = document.getElementById("link-url");
const addButton = document.getElementById("add-button");
const favoritesList = document.getElementById("favorites-list");

// Lấy dữ liệu từ Local Storage
let favorites = JSON.parse(localStorage.getItem("favorites")) || [];

// Hiển thị danh sách yêu thích
function renderFavorites() {
    favoritesList.innerHTML = ""; // Xóa danh sách cũ
    favorites.forEach((favorite, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
            <a href="${favorite.url}" target="_blank">${favorite.name}</a>
            <button onclick="removeFavorite(${index})">Xóa</button>
        `;
        favoritesList.appendChild(li);
    });
}

// Thêm liên kết mới
addButton.addEventListener("click", () => {
    const name = linkName.value.trim();
    const url = linkUrl.value.trim();

    if (name && url) {
        favorites.push({ name, url });
        localStorage.setItem("favorites", JSON.stringify(favorites));
        renderFavorites();
        linkName.value = "";
        linkUrl.value = "";
    } else {
        alert("Vui lòng nhập đầy đủ thông tin!");
    }
});

// Xóa liên kết
function removeFavorite(index) {
    favorites.splice(index, 1);
    localStorage.setItem("favorites", JSON.stringify(favorites));
    renderFavorites();
}

// Hiển thị danh sách ban đầu
renderFavorites();
