</div>
<!--.pusher -->

<script>
$('.open-sidebar').on('click', function() {
    $('.ui.inverted.vertical.menu').sidebar('toggle');
});

$('button[data-bs-toggle="modal"]').on('click', function() {
    var clone = $('.modal-backdrop').clone();
    $('.modal-backdrop').remove();
    $('.pusher').append(clone);
});

$('button[data-bs-dismiss="modal"]').on('click', function() {
    $('.modal-backdrop').remove();
    location.reload();
});


</script>

</body>

</html>