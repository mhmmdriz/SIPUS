// Make sure the document is ready before executing the script
$(document).ready(function() {
    // Attach a click event handler to the "Hapus" button
    $('.delete-btn').click(function() {
      // Get the data attributes from the button
      var memberNoktp = $(this).data('member-noktp');
      var memberName = $(this).data('member-name');

      // Set the data in the modal
      $('#memberNoktp').text(memberNoktp);
      $('#memberName').text(memberName);
      console.log(memberNoktp);

      // Set the delete link to the correct URL
      $('#deleteMemberButton').attr('href', '/change-status/' + memberNoktp);
    });
  });