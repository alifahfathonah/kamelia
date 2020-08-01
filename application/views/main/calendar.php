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
        owner = calEvent.event.extendedProps.owner;
        catatan = calEvent.event.extendedProps.catatan;
        deskripsi = calEvent.event.extendedProps.deskripsi;
        review = (calEvent.event.extendedProps.review) ? calEvent.event.extendedProps.review : "-";
        $("#nama").text(nama);
        $("#waktu").text(tanggal+', '+waktu);
        $("#lokasi").text(lokasi);
        $("#pembicara").text(pembicara);
        $("#pj").text(pj);
        $("#jenis").text(jenis);
        $("#owner").text(owner);
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
  html {
    max-width: 100%;
    height: 100%;
  }
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
    position: relative;
    min-height: 100%;
  }

  .fc-time{
      color: white;
  }
  .fc-title{
      color: white;
  }

  #calendar{
    max-width: 800px;
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

  



main{
  min-height: 100%;
  min-height: 100%;
  margin: 0 auto -155px;
  padding-bottom: 16rem;
}

.footer {
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: red;
  color: white;
}

.fa{
  color: #fff;
  font-size: 30px !important;
}

.links ul{
    list-style-type: none;    
}
.links li a{
    color: white;
    transition: color .2s;
}
.links li a:hover{
      text-decoration: none;
      color: #2ecc71;
}

.about-company i{
  font-size: 25px;
} 
.about-company a{
  color:white;
  transition: color .2s;
}

</style>
</head>
<body class="d-flex flex-column h-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
    <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Bootstrap
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('login') ?>">Login</a>
        </li>
    </ul>
  </div>
</nav>

<main class="text-center my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">


            <div id='script-warning'>
    <span>API Error</span>
  </div>

  <div id='loading'>loading...</div>

  <!-- Inisiasi fullcalendar -->
  <div class='container'>
      <div class="col-lg-12">
      </div>
  </div>
  <div id="calendar" style=""></div>


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
            <li class="list-group-item">Pemilik acara: <span id="owner"></span></li>
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

        </div>
    </div>

</main>

<footer class="footer d-flex mt-auto">
  <div class="container" style="padding: 50px;">
    <div class="row">
      <div class="col-lg-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae quo, suscipit officia ducimus neque, rerum soluta facilis temporibus ipsam aspernatur delectus quis. A omnis culpa quae quas repudiandae facilis nam.</p>
      </div>
      <div class="col-lg-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio aperiam, repudiandae doloremque laboriosam similique laudantium corporis quaerat debitis impedit quas minus reprehenderit, quis eligendi dolore id doloribus odit ratione minima.</p>
      </div>
      <div class="col-lg-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci ipsam quam aspernatur nulla et fugit sint perferendis ea, tenetur, est qui facilis officia, nemo soluta ipsa impedit, nesciunt fuga! Nemo!</p>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
