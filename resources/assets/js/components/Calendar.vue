<template>
    <div class="container">
      <div>
   <md-dialog-prompt
     :md-active.sync="active"
     v-model="value"
     md-title="Add Event:"
     md-input-maxlength="30"
     md-input-placeholder="Event"
     md-confirm-text="Done"
     @md-confirm="onConfirm" />
 </div>
<full-calendar :events="events" @day-click="dateSelected"  @event-created="multipledate" :config="config"></full-calendar>
    </div>
</template>

<script>
import 'fullcalendar/dist/fullcalendar.css';

    export default {
        name: 'DialogPrompt',
        mounted() {


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
      ],
      config:{
        defaultView:"month",
        allDay : false
      },
    active: false,
    Sel_day:'',
    value: null
    }
  },
  methods:{
    dateSelected(date, jsEvent, view)
    {
      // this.active = true;
      this.Sel_day = date.format();
    },
    onConfirm () {
      console.log(this.Sel_day);
      console.log(this.value);
      this.value = '';

      },
      multipledate(date)
      {
        // alert(event);
console.log(date);
        console.log(date.end.format());
        console.log(date.start.format());
      }
  }
    }
</script>
