// Make sure the document is ready before executing the script
$(document).ready(function() {
    // Attach a click event handler to the "Hapus" button for views anggota
    $('.delete-anggota-btn').click(function() {
      // Get the data attributes from the button
      var memberNoktp = $(this).data('member-noktp');
      var memberName = $(this).data('member-name');

      // Set the data in the modal
      $('#memberNoktp').text(memberNoktp);
      $('#memberName').text(memberName);

      document.getElementById("noktp").value = memberNoktp;
    });

    //views buku
    $('.delete-book-btn').click(function() {
      // Get the data attributes from the button
      var isbnBuku = $(this).data('buku-isbn');
      var judulBuku = $(this).data('buku-judul');

      // Set the data in the modal
      $('#isbnBuku').text(isbnBuku);
      $('#judulBuku').text(judulBuku);

      document.getElementById("deleteBookForm").action = "/buku/" + isbnBuku;
    });

});