// Array data produk
const daftarProduk = [
  {
    nama: "Smartphone X1",
    harga: "Rp 3.500.000",
    deskripsi: "Smartphone dengan layar AMOLED dan baterai tahan lama.",
    gambar: "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300",
    kategori: "elektronik"
  },
  {
    nama: "Kaos Polos Cotton",
    harga: "Rp 85.000",
    deskripsi: "Bahan katun combed 30s dingin dan nyaman dipakai sehari-hari.",
    gambar: "https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=300",
    kategori: "pakaian"
  },
  {
    nama: "Kacamata Hitam Aviator",
    harga: "Rp 150.000",
    deskripsi: "Kacamata hitam anti UV dengan bingkai metal elegan.",
    gambar: "https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=300",
    kategori: "aksesoris"
  },
  {
    nama: "Laptop Kerja Pro",
    harga: "Rp 12.000.000",
    deskripsi: "Performa kencang dengan prosesor terbaru dan penyimpanan SSD 512GB.",
    gambar: "https://laptopmedia.com/wp-content/uploads/2024/09/Swift-Go-14-AI-02-e1725465393450.jpg",
    kategori: "elektronik"
  },
  {
    nama: "Jaket Denim Klasik",
    harga: "Rp 250.000",
    deskripsi: "Jaket jeans tebal dengan potongan reguler fit yang modis.",
    gambar: "https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=300",
    kategori: "pakaian"
  }
];

const productContainer = document.getElementById("product-list");

// Fungsi murni untuk merender list produk ke layar
function tampilkanProduk(produkYangDitampilkan) {
  productContainer.innerHTML = "";

  if (produkYangDitampilkan.length === 0) {
    productContainer.innerHTML = "<p style='color: #888; font-style: italic;'>Produk tidak ditemukan...</p>";
    return;
  }

  produkYangDitampilkan.forEach(produk => {
    const productCard = `
      <div class="product-card">
        <img src="${produk.gambar}" alt="${produk.nama}">
        <div class="product-category">${produk.kategori}</div>
        <h3 class="product-title">${produk.nama}</h3>
        <p class="product-price">${produk.harga}</p>
        <p style="font-size: 0.85rem; color: #666; line-height: 1.4;">${produk.deskripsi}</p>
      </div>
    `;
    productContainer.innerHTML += productCard;
  });
}

// Fungsi utama untuk menangani pencarian dan pemilihan secara bersamaan
function filterDanCariProduk() {
  // Ambil nilai dari input pencarian dan jadikan huruf kecil (lowercase) agar tidak sensitif huruf kapital
  const kataKunci = document.getElementById("search-box").value.toLowerCase();
  
  // Ambil nilai kategori dari elemen select
  const kategoriDipilih = document.getElementById("category-select").value;

  // Lakukan penyaringan ganda (Filter Kategori DAN Pencarian Teks)
  const hasilFilter = daftarProduk.filter(produk => {
    // Cocokkan kategori
    const cocokKategori = (kategoriDipilih === "semua" || produk.kategori === kategoriDipilih);
    
    // Cocokkan nama atau deskripsi produk dengan kata kunci pencarian
    const cocokKataKunci = produk.nama.toLowerCase().includes(kataKunci) || 
                           produk.deskripsi.toLowerCase().includes(kataKunci);

    // Produk lolos jika memenuhi kedua syarat di atas
    return cocokKategori && cocokKataKunci;
  });

  // Tampilkan hasilnya
  tampilkanProduk(hasilFilter);
}

// Tampilkan semua produk saat pertama kali membuka halaman
tampilkanProduk(daftarProduk);