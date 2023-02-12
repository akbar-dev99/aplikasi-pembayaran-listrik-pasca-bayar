<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("datetimepicker-dashboard").flatpickr({
      inline: true,
      prevArrow: "<span title=\"Previous month\">&laquo;</span>",
      nextArrow: "<span title=\"Next month\">&raquo;</span>",
      defaultDate: new Date()
    });
  });
</script>