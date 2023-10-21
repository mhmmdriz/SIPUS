function getXMLHTTPRequest() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const searchResult = document.getElementById("searchResult");

    // Fungsi untuk mengirim permintaan pencarian dengan Ajax
    function searchTransactions() {
        const idtransaksi = searchInput.value;

        if (idtransaksi) {
            // Sembunyikan semua baris tabel
            const rows = document.getElementsByClassName("peminjaman-row");
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "none";
            }

            // Tampilkan baris yang sesuai dengan hasil pencarian
            const matchingRows = document.querySelectorAll(".peminjaman-row[data-idtransaksi='" + idtransaksi + "']");
            for (let i = 0; i < matchingRows.length; i++) {
                matchingRows[i].style.display = "table-row";
            }
        } else {
            // Tampilkan semua baris tabel jika input pencarian kosong
            const rows = document.getElementsByClassName("peminjaman-row");
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = "table-row";
            }
        }
    }

    // Merekam perubahan pada input pencarian
    searchInput.addEventListener("input", searchTransactions);
});