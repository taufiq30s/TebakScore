<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script> -->
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
  "use strict"
  // Inisialisasi dan deklarasi datetimepicker
  $('#datePicker').datetimepicker();
  var datePicker = $('#datePicker').data("DateTimePicker")


  $(document).ready(function() {
    // Set DateTime match dari database, jika ada 
    if (datePicker != null) datePicker.date(moment($('#matchTime').attr('data')));

    if(!$.fn.dataTable.isDataTable('#dtbListMatch')){
      console.log('mira');
      $('#dtblListMatch').DataTable({
        "paging": true,
        "autofit": true,
        "searching": true,
        "columnDefs": [{
            "orderable": false,
            "targets": 0
          },
          {
            "orderable": false,
            "targets": 5
          },
        ]
      });
    }
      
  });

  // Increment Decrement Score
  $('.btn-number').click(function(e) {
    e.preventDefault();

    var fieldName = $(this).attr('data-field');
    var type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      // Jika user tekan tombol minus
      if (type == 'minus') {
        // Kalau val sekarang >= 0
        if (currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }
        // Jika val sekarang < 0, matikan tombol minus
        if (parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }

      }
      // Jika user tekan tombol plus
      else if (type == 'plus') {
        // Enable kan tombol minus 
        if ($('.btnHome').prop('disabled') && fieldName == 'homeScore' || fieldName == 'homePredScore')
          $('.btnHome').prop('disabled', false);
        else if(input.val == "0") $('.btnHome').prop('disabled', true);

        if ($('.btnAway').prop('disabled') && fieldName == 'awayScore' || fieldName == 'awayPredScore')
          $('.btnAway').prop('disabled', false);
        else if(input.val == "0") $('.btnAway').prop('disabled', true);

        // jika val sekarang < val max, increment
        if (currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        // jika val sekarang >= val max, matikan tombol plus
        if (parseInt(input.val()) == input.attr('max')) {
          $(this).attr('disabled', true);
        }

      }
    } else {
      input.val(0);
    }
  });
  $('.input-number').focusin(function() {
    $(this).data('oldValue', $(this).val());
  });

  $('.input-number').change(function() {
    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }
  });

  $(".input-number").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });

  // Verifikasi jika tim rumah dan tamu sama
  $('#matchBtnSubmit').click(function(e) {
    e.preventDefault();

    if ($('#homeTeam').prop("disabled")) {
      swal({
          title: "Apakah anda yakin dengan score ini?",
          text: "Poin akan diberikan kepada member dengan tebakan yang tepat. Apakah anda yakin?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willUpdateScore) => {
          if (willUpdateScore) {
            $('#matchForm').submit();
          }
        });
    } else {
      if ($('#homeTeam').val() === $('#awayTeam').val()) {
        swal('Verifikasi Gagal', 'Nama Tim Rumah dan Tamu Tidak Boleh Sama', 'error');
      } else
        $('#matchForm').submit();
    }
  });
</script>