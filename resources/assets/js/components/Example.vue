<template>
    <div class="container">
<full-calendar :events="events"></full-calendar>
    </div>
</template>

<script>
import 'fullcalendar/dist/fullcalendar.css';

    export default {
        mounted() {
            console.log('Example Component mounted.')
        },
        data() {
    return {
      events: [
        {
            title  : 'event1',
            start  : '2019-02-01',
        },
        {
            title  : 'event2',
            start  : '2019-02-05',
            end    : '2019-02-07',
        },
        {
            title  : 'event3',
            start  : '2019-02-09T12:30:00',
            allDay : false,
        },
      ]
    }
  }
    }
</script>
