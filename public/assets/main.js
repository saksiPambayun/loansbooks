console.log("LoansBooks landing page loaded");

const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

hamburger.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});

// Data Katalog Buku
const books = [
    {
        id: 1,
        title: "Hujan",
        author: "Tere Liye",
        image: "image/hujan.png",
        description:
            "Blurb novel 'Hujan' karya Tere Liye menceritakan tentang persahabatan, cinta, dan perpisahan...",
        tag: "Tere Liye",
    },
    {
        id: 2,
        title: "Bumi",
        author: "Tere Liye",
        image: "image/hero.png",
        description:
            "Petualangan Raib, Seli, dan Ali di dunia paralel yang penuh dengan misteri dan kekuatan...",
        tag: "Tere Liye",
    },
    {
        id: 3,
        title: "Pulang",
        author: "Tere Liye",
        image: "image/hero.png",
        description:
            "Sebuah kisah tentang perjalanan pulang, melalui pertarungan demi pertarungan...",
        tag: "Tere Liye",
    },
];

function renderBooks() {
    const bookList = document.getElementById("book-list");
    if (!bookList) return;

    bookList.innerHTML = books
        .map(
            (book) => `
        <div class="book-card">
            <div class="book-image-container">
                <img src="${book.image}" alt="${book.title}" class="book-image">
                <div class="book-tag">${book.tag}</div>
            </div>
            <div class="book-content-row">
                <div class="book-text-col">
                    <h3 class="book-title">${book.title}</h3>
                    <p class="book-desc">${book.description}</p>
                </div>
                <a href="detail.html?id=${book.id}" class="btn-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="7" y1="17" x2="17" y2="7"></line>
                        <polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    `,
        )
        .join("");
}

// Render books when DOM is loaded
document.addEventListener("DOMContentLoaded", renderBooks);
