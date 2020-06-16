<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<script src="https://code.jquery.com/jquery-3.5.0.slim.min.js" integrity="sha256-MlusDLJIP1GRgLrOflUQtshyP0TwT/RHXsI1wWGnQhs=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href='<?=base_url('assets/calendar/packages/core/main.css')?>' rel='stylesheet' />
<link href='<?=base_url('assets/calendar/packages/daygrid/main.css')?>' rel='stylesheet' />
<link href='<?=base_url('assets/calendar/packages/timegrid/main.css')?>' rel='stylesheet' />
<link href='<?=base_url('assets/calendar/packages/list/main.css')?>' rel='stylesheet' />
<script src='<?=base_url('assets/calendar/packages/core/main.js')?>'></script>
<script src='<?=base_url('assets/calendar/packages/interaction/main.js')?>'></script>
<script src='<?=base_url('assets/calendar/packages/daygrid/main.js')?>'></script>
<script src='<?=base_url('assets/calendar/packages/timegrid/main.js')?>'></script>
<script src='<?=base_url('assets/calendar/packages/list/main.js')?>'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', ],
      header: {
        left: 'prev,next today',
        center: 'title',
        // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        right: 'dayGridMonth'
      },
      defaultDate: '<?=$defaultDate?>',
      locale: 'id',
    //   selectable: true,
      selectMirror: true,
      disableDragging: true,
      timeFormat: 'H(:mm)',
      editable: false,
      droppable: false,
      // navLinks: true, // can click day/week names to navigate views
      // eventLimit: true, // allow "more" link when too many events
    //   textColor: 'white',
      events: {
        url: '<?=site_url('api/calendar')?>',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block'
        }
      },
      eventTimeFormat: { // like '14:30:00'
        hour: '2-digit',
        minute: '2-digit',
        // second: '2-digit',
      },
      eventClick: function(calEvent, jsEvent, view) {
        tanggal = moment(calEvent.event.start).format('DD/MM/YYYY');
        waktu = moment(calEvent.event.start).format('HH:mm');
        nama = calEvent.event.title;
        lokasi = calEvent.event.extendedProps.lokasi;
        pembicara = calEvent.event.extendedProps.pembicara;
        pj = calEvent.event.extendedProps.pj;
        jenis = calEvent.event.extendedProps.jenis;
        catatan = calEvent.event.extendedProps.catatan;
        deskripsi = calEvent.event.extendedProps.deskripsi;
        review = (calEvent.event.extendedProps.review) ? calEvent.event.extendedProps.review : "-";
        $("#nama").text(nama);
        $("#waktu").text(tanggal+', '+waktu);
        $("#lokasi").text(lokasi);
        $("#pembicara").text(pembicara);
        $("#pj").text(pj);
        $("#jenis").text(jenis);
        $("#catatan").text(catatan);
        $("#deskripsi").text(deskripsi);
        $("#review").text(review);
        $('#eventModal').modal();
        // console.log(calEvent.event.start.toISOString());
        // alert('Coordinates: ' + calEvent.jsEvent.pageX + ',' + calEvent.jsEvent.pageY);
        // alert('View: ' + view.name);
        // change the border color just for fun
        // $(this).css('border-color', 'red');

      },
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  .fc-time{
      color: white;
  }
  .fc-title{
      color: white;
  }

  #script-warning {
    display: none;
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    color: red;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }

</style>
</head>
<body>

  <div id='script-warning'>
    <span>API Error</span>
  </div>

  <div id='loading'>loading...</div>

  <!-- Inisiasi fullcalendar -->
  <div id="calendar"></div>

  <!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="text-justify" id="nama">Title</h5>
        <ul class="list-group">
            <li class="list-group-item">Lokasi: <span id="lokasi"></span></li>
            <li class="list-group-item">Pembicara: <span id="pembicara"></span></li>
            <li class="list-group-item">Waktu: <span id="waktu"></span></li>
            <li class="list-group-item">Jenis Kegiatan: <span id="jenis"></span></li>
            <li class="list-group-item">Penanggungjawab: <span id="pj"></span></li>
            <li class="list-group-item">Deskripsi: <p id="deskripsi"></p></li>
            <li class="list-group-item">Catatan: <p id="catatan"></p></li>
            <li class="list-group-item">Review: <p id="review"></p></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


</body>
</html>
