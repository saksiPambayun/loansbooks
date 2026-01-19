console.log("LoansBooks Detail Page loaded");

// Hamburger Menu Toggle
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");

if (hamburger && navLinks) {
    hamburger.addEventListener("click", () => {
        navLinks.classList.toggle("active");
    });
}

// Data Buku Lengkap dengan Detail
const booksData = [
    {
        id: 1,
        title: "Hujan",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "456 Halaman",
        year: "2025",
        category: "Novel",
        image: "https://id-test-11.slatic.net/p/65337968507802877a5e00310243178c.jpg",
        description: `Blurb novel "Hujan" karya Tere Liye berkesan menarik (at poche yuktin point of rhose depar). Delun yang tenangnyo dengan menggunakan gayo bohoson gont! (agu bahasa, tokoh-tokoh yang petuh cinta peda'bab. kehidupannya di pengarangan. ruman bercecan. hingget alkhirnya leren merepa olat dini kembali ke owal cerita—darl darl iniloh, Laly remarahami bahwa teenangon menyimpan atau mempentahanconnya di tengos kilati dan gebal yang mendecat Bumi, di mana kout menjadi kunei pertocyanaan untuk manulia.`,
        tag: "Tere Liye",
    },
    {
        id: 2,
        title: "Bumi",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "440 Halaman",
        year: "2014",
        category: "Novel",
        image: "https://images.tokopedia.net/img/cache/700/VqbcmM/2022/10/25/8d3b5e0e-c0a8-4f5f-b5f5-8c5e5c5e5c5e.jpg",
        description: `Novel "Bumi" adalah buku pertama dalam serial "Bumi" karya Tere Liye. Cerita ini mengisahkan petualangan tiga remaja bernama Raib, Seli, dan Ali yang memiliki kekuatan supernatural. Raib memiliki kemampuan menghilang, Seli dapat mengendalikan cuaca, dan Ali memiliki kekuatan super. Mereka terjebat dalam petualangan di dunia paralel yang penuh dengan misteri, kekuatan magis, dan berbagai makhluk fantastis. Buku ini mengajarkan tentang persahabatan, keberanian, dan pentingnya melindungi orang-orang yang kita cintai.`,
        tag: "Tere Liye",
    },
    {
        id: 3,
        title: "Pulang",
        author: "Tere Liye",
        publisher: "Republika Penerbit",
        pages: "400 Halaman",
        year: "2015",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020822938.jpg",
        description: `"Pulang" adalah novel karya Tere Liye yang menceritakan tentang perjalanan hidup seorang tokoh yang penuh dengan perjuangan dan harapan. Novel ini mengisahkan tentang pencarian jati diri, makna pulang yang sesungguhnya, dan perjalanan spiritual yang mengharukan. Dengan gaya bercerita yang khas, Tere Liye mengajak pembaca untuk merenungkan arti sebenarnya dari "pulang" - bukan hanya pulang ke rumah fisik, tetapi juga pulang ke diri sendiri, kepada keluarga, dan kepada Tuhan. Cerita ini penuh dengan nilai-nilai kehidupan yang mendalam.`,
        tag: "Tere Liye",
    },
    {
        id: 4,
        title: "Bulan",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "400 Halaman",
        year: "2015",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020331843_Bulan.jpg",
        description: `"Bulan" adalah kelanjutan dari serial Bumi karya Tere Liye. Dalam novel ini, petualangan Raib, Seli, dan Ali berlanjut dengan hadirnya tokoh baru bernama Bulan yang memiliki kekuatan misterius. Cerita semakin menarik dengan konflik yang lebih besar di dunia paralel. Mereka harus menghadapi berbagai tantangan baru, musuh yang lebih kuat, dan misteri yang lebih dalam tentang dunia paralel dan kekuatan mereka. Novel ini mengajarkan tentang pengorbanan, loyalitas, dan kekuatan persahabatan yang sejati dalam menghadapi kesulitan.`,
        tag: "Tere Liye",
    },
    {
        id: 5,
        title: "Matahari",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "384 Halaman",
        year: "2016",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020384207_Matahari.jpg",
        description: `"Matahari" merupakan buku ketiga dari serial Bumi. Novel ini menghadirkan kisah yang lebih epik dengan skala pertempuran yang lebih besar. Raib, Seli, Ali, dan Bulan harus menghadapi ancaman terbesar dalam hidup mereka. Kekuatan gelap bangkit dan mengancam semua dunia paralel. Dalam novel ini, rahasia tentang klan Matahari terungkap, dan para tokoh harus membuat keputusan besar yang akan mengubah takdir mereka selamanya. Cerita penuh dengan aksi, emosi, dan pengorbanan yang mengharukan.`,
        tag: "Tere Liye",
    },
    {
        id: 6,
        title: "Ceros dan Batozar",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "370 Halaman",
        year: "2018",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020822945.jpg",
        description: `"Ceros dan Batozar" adalah buku keenam dari serial Bumi yang membawa pembaca ke petualangan baru yang lebih menegangkan. Novel ini mengisahkan tentang dua klan besar, Ceros dan Batozar, yang memiliki sejarah panjang dan konflik yang mendalam. Raib dan teman-temannya terlibat dalam konflik besar antara kedua klan ini. Mereka harus mengungkap rahasia masa lalu, menghadapi makhluk-makhluk mitos yang berbahaya, dan mencegah perang besar yang bisa menghancurkan semua dunia paralel. Cerita ini penuh dengan intrik politik, petualangan epik, dan persahabatan yang diuji.`,
        tag: "Tere Liye",
    },
    {
        id: 7,
        title: "Komet",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "368 Halaman",
        year: "2018",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020639185_Komet.jpg",
        description: `"Komet" adalah buku ketujuh dari serial Bumi yang mengungkap misteri tentang klan Komet. Dalam novel ini, masa lalu yang kelam terungkap dan membawa dampak besar bagi masa kini. Para tokoh harus menghadapi kenyataan pahit tentang asal-usul kekuatan mereka dan pilihan sulit yang harus diambil. Petualangan semakin berbahaya dengan munculnya musuh baru yang memiliki kekuatan luar biasa. Novel ini mengajarkan tentang menerima masa lalu, membuat perdamaian dengan diri sendiri, dan berani menghadapi takdir dengan kepala tegak.`,
        tag: "Tere Liye",
    },
    {
        id: 8,
        title: "Selena",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "396 Halaman",
        year: "2020",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020633664_Selena.jpg",
        description: `"Selena" adalah novel terbaru dari serial Bumi yang menghadirkan tokoh baru bernama Selena. Karakter ini membawa dinamika baru dalam petualangan Raib dan kawan-kawan. Selena memiliki kekuatan unik dan masa lalu yang misterius yang berkaitan erat dengan nasib semua dunia paralel. Dalam novel ini, ancaman terbesar muncul dan semua tokoh harus bersatu untuk menghadapinya. Cerita penuh dengan twist mengejutkan, pertempuran epik, dan momen-momen emosional yang menyentuh hati. Ini adalah novel yang tidak boleh dilewatkan oleh penggemar serial Bumi.`,
        tag: "Tere Liye",
    },
    {
        id: 9,
        title: "Nebula",
        author: "Tere Liye",
        publisher: "PT Gramedia Pustaka Utama",
        pages: "420 Halaman",
        year: "2020",
        category: "Novel",
        image: "https://cdn.gramedia.com/uploads/items/9786020639208_Nebula.jpg",
        description: `"Nebula" menutup serial Bumi dengan cara yang epik dan memuaskan. Novel ini menghadirkan pertempuran terakhir yang menentukan nasib semua dunia paralel. Semua misteri terungkap, semua karakter mendapat closure yang layak, dan pembaca akan dibawa dalam perjalanan emosional yang luar biasa. Tere Liye menutup serial ini dengan sempurna, memberikan ending yang memuaskan namun tetap membuka kemungkinan untuk petualangan baru. Ini adalah novel yang wajib dibaca untuk menutup perjalanan panjang bersama Raib, Seli, Ali, dan teman-teman mereka.`,
        tag: "Tere Liye",
    },
];

// Fungsi untuk mendapatkan ID dari URL
function getBookIdFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return parseInt(urlParams.get("id")) || 1;
}

// Fungsi untuk menampilkan detail buku
function displayBookDetail() {
    const bookId = getBookIdFromURL();
    const book = booksData.find((b) => b.id === bookId);

    if (!book) {
        // Jika buku tidak ditemukan, redirect ke katalog
        window.location.href = "katalog.html";
        return;
    }

    // Update elemen HTML dengan data buku
    document.getElementById("bookImage").src = book.image;
    document.getElementById("bookImage").alt = book.title;
    document.getElementById("bookTitle").textContent = book.title;
    document.getElementById("bookAuthor").textContent = book.author;
    document.getElementById("bookPublisher").textContent = book.publisher;
    document.getElementById("bookPages").textContent = book.pages;
    document.getElementById("bookYear").textContent = book.year;
    document.getElementById("bookDescription").textContent = book.description;

    // Update button text
    document.getElementById("borrowBtn").innerHTML = `
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="20"
      height="20"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round"
    >
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
      <circle cx="12" cy="7" r="4"></circle>
    </svg>
    ${book.pages}
  `;

    // Update page title
    document.title = `${book.title} - LoansBooks`;
}

// Event listener untuk tombol pinjam
function setupBorrowButton() {
    const borrowBtn = document.getElementById("borrowBtn");
    if (borrowBtn) {
        borrowBtn.addEventListener("click", () => {
            const bookId = getBookIdFromURL();
            const book = booksData.find((b) => b.id === bookId);
            alert(
                `Anda akan meminjam buku "${book.title}". Fitur ini segera hadir!`,
            );
        });
    }
}

// Initialize saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    displayBookDetail();
    setupBorrowButton();
});

// Export untuk digunakan di file lain (opsional)
if (typeof module !== "undefined" && module.exports) {
    module.exports = { booksData, displayBookDetail };
}
