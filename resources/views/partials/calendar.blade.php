<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kalender Islam - Masjid Al-Firdaus</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100">
  <!-- Header dengan posisi fixed -->
  <header class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    @include('partials.header')
  </header>

  <!-- Konten utama dengan padding-top untuk menghindari header -->
  <div class="container mx-auto px-4 pt-36 pb-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h1 class="text-2xl md:text-3xl font-bold text-green-800 mb-6">
        <i class="fas fa-calendar-alt mr-2"></i>Kalender Hijriyah
      </h1>
      <div id="calendar"></div>
    </div>
  </div>

  @include('partials.footer')

  <!-- FullCalendar v5 -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', async function() {
      const calendarEl = document.getElementById('calendar');
      let hijriMap = new Map();

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        datesSet: async function(dateInfo) {
          await loadHijriData(dateInfo.start);
        },
        dayCellContent: function(info) {
          const dateStr = info.date.toISOString().split('T')[0];
          const hijriDate = hijriMap.get(dateStr);

          return {
            html: `
              <div class="fc-daygrid-day-frame">
                <div class="fc-daygrid-day-number text-lg font-bold">
                  ${info.dayNumberText} ${hijriDate ? `<span class="text-gray-500 text-sm">(${hijriDate.year} H)</span>` : ''}
                </div>
                ${hijriDate ? `
                  <div class="hijri-date">
                    <div class="text-gray-600 text-sm">${hijriDate.date}</div>
                    <div class="text-green-600 text-xs">${hijriDate.month}</div>
                  </div>
                ` : ''}
              </div>
            `
          };
        }
      });

      async function loadHijriData(startDate) {
        try {
          const month = startDate.getMonth() + 1;
          const year = startDate.getFullYear();

          const response = await fetch(`https://api.aladhan.com/v1/gToHCalendar/${month}/${year}`);
          const data = await response.json();

          hijriMap.clear();

          data.data.forEach(day => {
            const gDateParts = day.gregorian.date.split('-');
            const gDate = `${gDateParts[2]}-${gDateParts[1]}-${gDateParts[0]}`;

            hijriMap.set(gDate, {
              date: day.hijri.date,
              month: day.hijri.month.en,
              year: day.hijri.year,
              holidays: day.hijri.holidays || []
            });
          });

          calendar.render();
        } catch (error) {
          console.error('Gagal load data:', error);
          alert('Gagal memuat data kalender!');
        }
      }

      calendar.render();
      await loadHijriData(new Date());
    });
  </script>

  <style>
    /* Default Styles */
    .fc-daygrid-day-frame {
      min-height: 100px;
      padding: 8px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .fc-daygrid-day-number {
      font-size: 18px;
      font-weight: bold;
    }
    .hijri-date {
      border-top: 1px solid #eee;
      padding-top: 4px;
    }
    .fc-day-today {
      background-color: #f0fff4;
    }

    /* Mobile View Styles */
    @media (max-width: 768px) {
      .fc-header-toolbar {
        flex-direction: column;
        align-items: flex-start;
      }
      .fc-toolbar-chunk {
        margin-bottom: 8px;
      }
      .fc-toolbar-title {
        font-size: 1.2em !important;
      }
      .fc-button {
        padding: 4px 8px !important;
        font-size: 12px !important;
      }
      .fc-daygrid-day-frame {
        min-height: 80px;
        padding: 6px;
      }
      .fc-daygrid-day-number {
        font-size: 16px;
      }
      .hijri-date {
        font-size: 12px;
      }
    }

    @media (max-width: 480px) {
      .fc-daygrid-day-frame {
        min-height: 100px;
        padding: 8px;
      }
      .fc-daygrid-day-number {
        font-size: 18px;
      }
      .hijri-date {
        font-size: 14px;
      }
      .fc-daygrid-body td {
        min-width: 100px !important;
      }
    }
  </style>
</body>
</html>