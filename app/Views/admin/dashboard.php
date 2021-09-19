<?= $this->extend('admin/main'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Admin</a>
      </li>
      <li class="breadcrumb-item active">Kalender Events</li>
    </ol>
    <!-- Icon Cards-->
    <!-- Example DataTables Card-->

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: '',
            right: 'title'
          },
          initialDate: '<?= date('Y-m-d') ?>',
          navLinks: true, // can click day/week names to navigate views
          businessHours: true, // display business hours
          editable: true,
          selectable: true,
          events: [{
              title: 'Kota Kupang | Lapangan Bola',
              start: '2021-09-13',
              end: '2021-09-20'
            },
            {
              title: 'Kota Kupang | Lapangan Volley',
              start: '2021-09-16',
              end: '2021-09-20',
              color: 'red'
            },
            {
              title: 'Kota Kupang | Lapangan Basket',
              start: '2021-09-16',
              end: '2021-09-18',
              color: 'orange'
            },
            {
              title: 'Party',
              start: '2020-09-29T20:00:00'
            }
          ]
        });

        calendar.render();
      });
    </script>
    <center>
      <h3>Kalender Events</h3>
    </center>

    <center>
      <div id='calendar' style="max-width: 600px;"></div>
    </center>

  </div>
</div>
<!-- /.container-fluid-->

<?= $this->endSection(); ?>