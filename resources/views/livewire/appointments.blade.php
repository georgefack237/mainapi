<div>
    <div class="header bg-secondary py-4">
        <div class="container-fluid">
            <div class="header-body">
                <div class="align-items-center mt-4 py-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="mb-4 h1">Randez-vous</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3">
        <div id='calendar'></div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    initialDate: new Date(),
                    editable: true,
                    navLinks: true, // can click day/week names to navigate views
                    dayMaxEvents: true, // allow "more" link when too many events
                    events: '/client/get-events'
                });

                calendar.render();
            });
        </script>
    @endpush
</div>
